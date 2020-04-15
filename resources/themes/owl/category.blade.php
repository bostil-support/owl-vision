@php
    /** @var \App\Models\Category $category */
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.page-info', ['breadcrumbs' => $category->breadcrumbs])

    <!-- Category section -->
    <section class="category-section spad">
        <div class="container">
            <div class="row">
                @include('partials.filter')
                <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <div class="tag-sale">ON SALE</div>
                                    <img src="{{ asset('assets/img/product/6.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Black and White Stripes Dress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/7.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/8.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/10.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Black and White Stripes Dress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/11.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/12.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/5.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/9.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/1.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <div class="tag-new">new</div>
                                    <img src="{{ asset('assets/img/product/2.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Black and White Stripes Dress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/3.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('assets/img/product/4.jpg') }}" alt="">
                                    <div class="pi-links">
                                        <a href="#" class="add-card"><i
                                                    class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                        <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h6>$35,00</h6>
                                    <p>Flamboyant Pink Top </p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center w-100 pt-3">
                            <button class="site-btn sb-line sb-dark">LOAD MORE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category section end -->
@endsection
