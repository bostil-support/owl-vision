<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('page.main'));
});

Breadcrumbs::for('frontend.shop.category', function ($trail, $category) {
    if ($category->parent) {
        $trail->parent('frontend.shop.category', $category->parent);
    } else {
        $trail->parent('home');
    }
    $trail->push($category->name, route('frontend.shop.category', $category->slug));
});

Breadcrumbs::for('frontend.shop.product', function ($trail, $category, $product) {
    if ($category) {
        $trail->parent('frontend.shop.category', $category);
    }
    $trail->push($product->name, route('frontend.shop.category', $product->slug));
});

Breadcrumbs::for('page.cart', function ($trail) {
    $trail->parent('home');
    $trail->push('Your cart', route('page.cart'));
});

Breadcrumbs::for('page.checkout', function ($trail) {
    $trail->parent('page.cart');
    $trail->push('Checkout', route('page.checkout'));
});

Breadcrumbs::for('page.contact', function ($trail) {
    $trail->parent('home');
    $trail->push('Contact', route('page.contact'));
});