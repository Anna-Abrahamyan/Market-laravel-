<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\User_Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function show(): View
    {
        $products = Product::query()->get();

        return view('home', ['products' => $products]);
    }

    public function addProductToCart(Request $request): Response | bool
    {
        $auth_token = $request->cookie('auth_token');
        $productId = $request->json('id');
        try{
            $user = User::query()->where('auth_token', $auth_token)->first();
                    $userProduct = new User_Product();
                    $userProduct->user_id = $user->id;
                    $userProduct->product_id = $productId;
                    $userProduct->save();
                    return response(200);
        } catch(Throwable $e) {
            report($e);
            return false;
        }
    }
}
