<?php

namespace App\Services;

use App\Contracts\IBasketlistModel;
use App\Contracts\IEcommerceModel;
use App\Traits\Purchasable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class Basketlist extends Ecommerce
{
    /**
     * Basketlist constructor.
     * @param Guard|null $guard
     * @param IEcommerceModel $model
     * @param string $cahceKey
     * @throws \Exception
     */
    public function __construct(?Guard $guard, IEcommerceModel $model, string $cahceKey)
    {
        if(!in_array(IBasketlistModel::class, class_implements($model))) {
            throw new \Exception(sprintf('%s must implement interface %s', get_class($this->instance), IBasketlistModel::class));
        }
        parent::__construct($guard, $model, $cahceKey);
    }

    /**
     * @param Model $model
     * @param int $quantity
     * @return bool|null
     * @throws \Exception
     */
    public function add(Model $model, int $quantity = 1): ?bool
    {
        $cartItem = $this->getCartItem($model);
        $cartItem->quantity += $quantity;
        return $cartItem->save();
    }

    /**
     * @param Model $model
     * @param int $quantity
     * @return bool|null
     * @throws \Exception
     */
    public function removeQty(Model $model, int $quantity = 1): ?bool
    {
        $cartItem = $this->getCartItem($model);
        $cartItem->quantity -= $quantity;
        return $cartItem->save();
    }

    public function count_items(): int
    {
        return $this->items->sum('quantity');
    }

    /**
     * @param Model $model
     * @return IEcommerceModel|\Illuminate\Database\Eloquent\Builder|Model
     * @throws \Exception
     */
    private function getCartItem(Model $model)
    {
        $this->canModel($model);
        return $this->instance->firstOrNew(
            $this->prepareData(
                [
                    'product_id' => $model->getKey(),
                    'model' => get_class($model),
                ]
            )
        );
    }
}