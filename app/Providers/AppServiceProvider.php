<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Type_product;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('header',function($view){
            $loai_sp=Type_product::all();
            $view->with('loai_sp',$loai_sp);
        });
        
        view()->composer('page.product_type',function($view){
            $prouct_new=Type_product::where('new',1)->orderBy('id','DESC')->skip(1)->take(8)->get();
            $view->with('product_new',$prouct_new);
        });

        												
	    view()->composer('header', function ($view) {											
         if (Session('cart')) {											
            $oldCart = Session::get('cart');											
            $cart = new Cart($oldCart);											
            $view->with(['cart' => Session::get('cart'), 											
            'product_cart' => $cart->items, 											
            'totalPrice' => $cart->totalPrice, 											
            'totalQty' => $cart->totalQty											
            ]);											
         }											
        });											
    
    }
}
