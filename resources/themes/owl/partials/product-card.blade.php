@php
/** @var \App\Models\Product $product */
@endphp
<div class="col-lg-4 col-sm-6">
    <div class="product-item">
        <div class="pi-pic">
{{--            <div class="tag-sale">ON SALE</div>--}}
            <a href="{{ route('frontend.shop.product', [$category->slug, $product->slug]) }}"><img src="{{ asset('assets/img/placeholders/500x775.jpg') }}" alt=""></a>
            <div class="pi-links">
                @if(config('ecommerce.basketlist.enabled'))
                    <a href="javascript:document.getElementById('cart_add_{{$product->id}}').submit()" class="add-card"><i
                                class="flaticon-bag"></i><span>ADD TO CART</span></a>
                    <form style="display: none;" id="cart_add_{{$product->id}}" action="{{ route('frontend.cart.add', $product->slug) }}" method="POST">
                        @csrf
                    </form>
                @endif
                @if(config('ecommerce.wishlist.enabled'))
                    <a href="javascript:document.getElementById('wishlist_add_{{$product->id}}').submit()" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                    <form style="display: none;" id="wishlist_add_{{$product->id}}" action="{{ route('frontend.wishlist.add', $product->slug) }}" method="POST">
                        @csrf
                    </form>
                @endif
            </div>
        </div>
        <div class="pi-text">
            <h6>{{ \App\Helpers\Shop::price($product->price) }}</h6>
            <p>{{ $product->name }}</p>
        </div>
    </div>
</div>