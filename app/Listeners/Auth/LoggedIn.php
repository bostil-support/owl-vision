<?php


namespace App\Listeners\Auth;


use App\Models\Cart;
use App\Models\Compare;
use App\Models\Wish;
use App\Providers\OwlVisionServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoggedIn
{
    public function handle(Login $event)
    {
        $basketlistCacheKey = config('ecommerce.basketlist.cacheKey') ?? OwlVisionServiceProvider::DEFAULT_BASKETLIST_CACHE_KEY;
        $cartItems = Cart::ofUser(Cookie::get($basketlistCacheKey), Auth::guard($event->guard))->get();
        if ($cartItems->count()) {
            $cartItems->each(
                function (Cart $cartItem) use ($event) {
                    $cartItem->timestamps = false;
                    $cartItem->update(
                        [
                            'cache_id' => null,
                            'user_id' => Auth::guard($event->guard)->id(),
                            'guard' => get_class(Auth::guard($event->guard)->user())
                        ]
                    );
                }
            );
            // Delete duplicates
            $cartItems->groupBy(['product_id', 'model'])->filter(
                function (Collection $items) {
                    return $items->flatten()->count() > 1;
                }
            )->each(
                function (Collection $cartItems) {
                    $cartItems = $cartItems->flatten()->sortBy('id');
                    $chunk = $cartItems->splice(1);
                    $chunk->each(
                        function (Cart $cartItem) use ($cartItems) {
                            $cartItems[0]->update(['quantity' => $cartItems[0]->quantity + $cartItem->quantity,'updated_at' => $cartItem->updated_at]);
                            $cartItem->delete();
                        }
                    );
                }
            );
        }
        Cookie::queue(Cookie::forget($basketlistCacheKey));



        $comparelistCacheKey = config('ecommerce.comparelist.cacheKey') ?? OwlVisionServiceProvider::DEFAULT_COMPARELIST_CACHE_KEY;
        $compares = Compare::ofUser(Cookie::get($comparelistCacheKey), Auth::guard($event->guard))->get();
        if ($compares->count()) {
            $compares->each(
                function (Compare $compare) use ($event) {
                    $compare->timestamps = false;
                    $compare->update(
                        [
                            'cache_id' => null,
                            'user_id' => Auth::guard($event->guard)->id(),
                            'guard' => get_class(Auth::guard($event->guard)->user())
                        ]
                    );
                }
            );
            // Delete duplicates
            $compares->groupBy(['product_id', 'model'])->filter(
                function (Collection $items) {
                    return $items->flatten()->count() > 1;
                }
            )->each(
                function (Collection $compares) {
                    $compares = $compares->flatten()->sortBy('id');
                    $chunk = $compares->splice(1);
                    $chunk->each(
                        function (Compare $compare) use ($compares) {
                            $compares[0]->update(['updated_at' => $compare->updated_at]);
                            $compare->delete();
                        }
                    );
                }
            );
        }
        Cookie::queue(Cookie::forget($comparelistCacheKey));



        $wishlistCacheKey = config('ecommerce.wishlist.cacheKey') ?? OwlVisionServiceProvider::DEFAULT_WISHLIST_CACHE_KEY;
        $wishes = Wish::ofUser(Cookie::get($wishlistCacheKey), Auth::guard($event->guard))->get();
        if ($wishes->count()) {
            $wishes->each(
                function (Wish $wish) use ($event) {
                    $wish->timestamps = false;
                    $wish->update(
                        [
                            'cache_id' => null,
                            'user_id' => Auth::guard($event->guard)->id(),
                            'guard' => get_class(Auth::guard($event->guard)->user())
                        ]
                    );
                }
            );
            // Delete duplicates
            $wishes->groupBy(['product_id', 'model'])->filter(
                function (Collection $items) {
                    return $items->flatten()->count() > 1;
                }
            )->each(
                function (Collection $wishes) {
                    $wishes = $wishes->flatten()->sortBy('id');
                    $chunk = $wishes->splice(1);
                    $chunk->each(
                        function (Wish $wish) use ($wishes) {
                            $wishes[0]->update(['updated_at' => $wish->updated_at]);
                            $wish->delete();
                        }
                    );
                }
            );
        }
        Cookie::queue(Cookie::forget($wishlistCacheKey));
    }
}