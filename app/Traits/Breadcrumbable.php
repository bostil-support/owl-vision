<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait Breadcrumbable
{
    public function initializeBreadcrumbable()
    {
        $this->append('breadcrumbs');
    }

    public function getBreadcrumbsAttribute(): array
    {
        return array_reverse($this->parseBreadcrumbs());
    }

    private function parseBreadcrumbs(Model $model = null): array
    {
        $breadcrumbs = [];
        if (!$model) {
            $model = $this;
        }
        if (Arr::has($model, ['name', 'slug'])) {
            $breadcrumbs[route(
                "frontend.{$this->getRouterName()}",
                $model->getAttribute('slug')
            )] = $model->getAttribute('name');
            $model->load('parent');
            if ($model->parent) {
                $breadcrumbs = array_merge($breadcrumbs, $this->parseBreadcrumbs($model->parent));
            }
        }
        return $breadcrumbs;
    }

    public function getRouterName(): string
    {
        return 'shop.category';
    }
}