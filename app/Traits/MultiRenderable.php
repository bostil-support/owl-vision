<?php


namespace App\Traits;


use Illuminate\Support\Str;

trait MultiRenderable
{
    public function initializeMultiRenderable()
    {
        $this->append('view');
    }

    public function getViewAttribute(): string
    {
        $view = Str::kebab(class_basename(__CLASS__));
        if (isset($this->template) && $this->template) {
            return $this->isViewExsists($this->template) ? $this->template : $view;
        }
        if (isset($this->slug) && $this->isViewExsists($viewSluggable = sprintf('%s-%s', $view, $this->slug))) {
            return $viewSluggable;
        }
        return $view;
    }

    private function isViewExsists($view): bool
    {
        return view()->exists($view);
    }
}