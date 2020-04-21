@php
    /** @var \App\Models\Category $category */
    /** @var \App\Models\Product $product */
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-info')
    <!-- product section -->
    <section class="product-section">
        <div class="container">
            <div class="back-link">
                <a href="{{ route('frontend.shop.category', $category->slug) }}"> &lt;&lt; Back to Category</a>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-pic-zoom">
                        <img class="product-big-img" src="{{ asset('assets/img/placeholders/1000x1358.jpg') }}" alt="">
                    </div>
                    <div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
                        <div class="product-thumbs-track">
                            <div class="pt active"
                                 data-imgbigurl="{{ asset('assets/img/placeholders/1000x1358.jpg') }}"><img
                                        src="{{ asset('assets/img/placeholders/116x116.jpg') }}" alt=""></div>
                            <div class="pt"
                                 data-imgbigurl="{{ asset('assets/img/placeholders/1000x1358-yellow.jpg') }}"><img
                                        src="{{ asset('assets/img/placeholders/116x116-yellow.jpg') }}" alt=""></div>
                            <div class="pt" data-imgbigurl="{{ asset('assets/img/placeholders/1000x1358-green.jpg') }}">
                                <img
                                        src="{{ asset('assets/img/placeholders/116x116-green.jpg') }}" alt=""></div>
                            <div class="pt" data-imgbigurl="{{ asset('assets/img/placeholders/1000x1358-blue.jpg') }}">
                                <img
                                        src="{{ asset('assets/img/placeholders/116x116-blue.jpg') }}" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 product-details">
                    <h2 class="p-title">{{ $product->name }}</h2>
                    <h3 class="p-price">{{ \App\Helpers\Shop::price($product->price) }}</h3>
                    <h4 class="p-stock">Available: <span>In Stock</span></h4>
                    <div class="p-rating">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o fa-fade"></i>
                    </div>
                    <div class="p-review">
                        <a href="">3 reviews</a>|<a href="">Add your review</a>
                    </div>
                    <div class="fw-size-choose">
                        <p>Size</p>
                        <div class="sc-item">
                            <input type="radio" name="sc" id="xs-size">
                            <label for="xs-size">32</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" name="sc" id="s-size">
                            <label for="s-size">34</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" name="sc" id="m-size" checked="">
                            <label for="m-size">36</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" name="sc" id="l-size">
                            <label for="l-size">38</label>
                        </div>
                        <div class="sc-item disable">
                            <input type="radio" name="sc" id="xl-size" disabled>
                            <label for="xl-size">40</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" name="sc" id="xxl-size">
                            <label for="xxl-size">42</label>
                        </div>
                    </div>
                    <div class="quantity">
                        <p>Quantity</p>
                        <form id="add_to_cart" action="{{ route('frontend.cart.add', $product->slug) }}" method="POST" class="pro-qty">
                            <input type="number" min="1" name="quantity" value="1">
                            @csrf
                        </form>
                    </div>
                    <a href="javascript:document.getElementById('add_to_cart').submit()" class="site-btn">SHOP NOW</a>
                    <div id="accordion" class="accordion-area">
                        <div class="panel">
                            <div class="panel-header" id="headingOne">
                                <button class="panel-link active" data-toggle="collapse" data-target="#collapse1"
                                        aria-expanded="true" aria-controls="collapse1">information
                                </button>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so
                                        dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te
                                        mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                                    <p>Approx length 66cm/26" (Based on a UK size 8 sample)</p>
                                    <p>Mixed fibres</p>
                                    <p>The Model wears a UK size 8/ EU size 36/ US size 4 and her height is 5'8"</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-header" id="headingTwo">
                                <button class="panel-link" data-toggle="collapse" data-target="#collapse2"
                                        aria-expanded="false" aria-controls="collapse2">care details
                                </button>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="panel-body">
                                    <img src="{{ asset('assets/img/cards.png') }}" alt="">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so
                                        dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te
                                        mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-header" id="headingThree">
                                <button class="panel-link" data-toggle="collapse" data-target="#collapse3"
                                        aria-expanded="false" aria-controls="collapse3">shipping & Returns
                                </button>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="headingThree"
                                 data-parent="#accordion">
                                <div class="panel-body">
                                    <h4>7 Days Returns</h4>
                                    <p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so
                                        dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te
                                        mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="social-sharing">
                        <a href=""><i class="fa fa-google-plus"></i></a>
                        <a href=""><i class="fa fa-pinterest"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product section end -->


    <!-- RELATED PRODUCTS section -->
    <section class="related-product-section">
        <div class="container">
            <div class="section-title">
                <h2>RELATED PRODUCTS</h2>
            </div>
            <div class="product-slider owl-carousel">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ asset('assets/img/product/1.jpg') }}" alt="">
                        <div class="pi-links">
                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>$35,00</h6>
                        <p>Flamboyant Pink Top </p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="pi-pic">
                        <div class="tag-new">New</div>
                        <img src="{{ asset('assets/img/product/2.jpg') }}" alt="">
                        <div class="pi-links">
                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>$35,00</h6>
                        <p>Black and White Stripes Dress</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ asset('assets/img/product/3.jpg') }}" alt="">
                        <div class="pi-links">
                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>$35,00</h6>
                        <p>Flamboyant Pink Top </p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ asset('assets/img/product/4.jpg') }}" alt="">
                        <div class="pi-links">
                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>$35,00</h6>
                        <p>Flamboyant Pink Top </p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ asset('assets/img/product/6.jpg') }}" alt="">
                        <div class="pi-links">
                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>$35,00</h6>
                        <p>Flamboyant Pink Top </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- RELATED PRODUCTS section end -->
@endsection
