<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsIndexRequest;
use App\Models\User;
use Illuminate\View\View;
use Throwable;

class ShoppingCartController extends Controller
{
    public function index(ProductsIndexRequest $request): View | bool {

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
