<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\User;
use Illuminate\View\View;
use Throwable;

class ShoppingCartController extends Controller
{
    public function getUserProducts(ProductsRequest $request): View | bool {

        $auth_token = $request->cookie('auth_token');
        try{
                $user = User::query()
                    ->where('auth_token', $auth_token)
                    ->first();
                return view('cart', ['userProducts' => $user->products]);
        } catch(Throwable $e) {
            report($e);
            return false;
        }
    }
}
