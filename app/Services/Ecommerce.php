<?php

namespace App\Services;

use App\Contracts\IEcommerceModel;
use App\Traits\Purchasable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

abstract class Ecommerce
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder $instance
     */
    protected $instance;

    /**
     * @var string $cacheKey
     */
    private $cacheKey;

    /**
     * @var Guard $guard
     */
    private $guard;

    /**
     * @var Collection $items
     */
    protected $items;

    /**
     * Ecommerce constructor.
     * @param Guard|null $guard
     * @param IEcommerceModel $model
     * @param string $cahceKey
     */
    public function __construct(?Guard $guard, IEcommerceModel $model, string $cahceKey)
    {
        if (!$guard) {
            if ($cacheKey = Cookie::get($cahceKey)) {
                $this->cacheKey = $cacheKey;
            } else {
                $this->cacheKey = uniqid($cahceKey . '_', true);
                Cookie::queue(Cookie::forever($cahceKey, $this->cacheKey));
            }
        }
        $this->instance = $model;
        $this->guard = $guard;
        $this->items = collect();
        $this->queryAndSetItems();
    }

    private function queryAndSetItems(): void
    {
        $this->items = $this->instance->ofUser($this->cacheKey, $this->guard)->get();
    }

    /**
     * @param Model $model
     * @throws \Exception
     */
    protected function canModel(Model $model): void
    {
        switch (get_class($this)) {
            case Basketlist::class:
                $allowedModels = config('ecommerce.basketlist.models');
                break;
            case Wishlist::class:
                $allowedModels = config('ecommerce.wishlist.models');
                break;
            default:
                $allowedModels = [];
                break;
        }
        if (!in_array(get_class($model), $allowedModels)) {
            throw new \Exception(
                sprintf('%s for %s not allowed', get_class($model), strtolower(class_basename($this)))
            );
        }
    }

    /**
     * @param array $data
     * @return array|string[]
     */
    protected function prepareData(array $data): array
    {
        return array_merge(
            ($this->guard) ? [
                'user_id' => $this->guard->id(),
                'guard' => get_class($this->guard->user())
            ] : [
                'cache_id' => $this->cacheKey
            ],
            $data
        );
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function add(Model $model): ?bool
    {
        $this->canModel($model);
        $add = $this->instance->updateOrCreate(
            $this->prepareData(
                [
                    'product_id' => $model->getKey(),
                    'model' => get_class($model)
                ]
            )
        )->touch();
        $this->queryAndSetItems();
        return $add;
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function remove(Model $model): ?bool
    {
        $this->canModel($model);
        $remove = $this->instance->ofUser($this->cacheKey, $this->guard)->byItem($model)->delete();
        $this->queryAndSetItems();
        return $remove;
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(): ?bool
    {
        return $this->instance->ofUser($this->cacheKey, $this->guard)->delete();
    }

    /**
     * @return Collection
     */
    public function items(): Collection
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count_items(): int
    {
        return $this->items->count();
    }

    /**
     * @return string
     */
    public function cacheKey(): string
    {
        return $this->cacheKey;
    }

    /**
     * @return Guard
     */
    public function guard(): Guard
    {
        return $this->guard;
    }
}