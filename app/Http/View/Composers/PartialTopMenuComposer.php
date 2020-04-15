<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class PartialTopMenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', Category::published()->parents()->topMenu()->get(['id', 'name', 'slug']));
    }
}