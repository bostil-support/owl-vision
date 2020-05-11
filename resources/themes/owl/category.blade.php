@php
    /** @var \App\Models\Category $category */
    /** @var \Illuminate\Pagination\LengthAwarePaginator $products */
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.page-info')
    <!-- Category section -->
    <section class="category-section spad">
        <div class="container">
            <div class="row">
                @include('partials.filter')
                <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="row">
                        @if($products->count())
                            @each('partials.product-card', $products, 'product')
                            @if($products->hasPages())
                                <div class="text-center w-100 pt-3">
                                    <button class="site-btn sb-line sb-dark">LOAD MORE</button>
                                </div>
                            @endif
                        @else
                            <h3 class="col text-center">No products for this category</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category section end -->
@endsection
