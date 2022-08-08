<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function show(): View {
        return view('register');
    }

    public function register(RegisterRequest $request): RedirectResponse {
       $user = new User();
       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->password = Hash::make($request->input('password'));
       $user->save();
       return redirect()->route('login');
   }
}
