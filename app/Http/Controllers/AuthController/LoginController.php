<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;


class LoginController extends Controller
{
    const AUTH = 'auth_token';
    public function show(): View {
        return view('login');
    }

    public function login(LoginRequest $request): RedirectResponse | bool
    {
        $email = $request->input('email');
        $password = $request->input('password');
        try{
           $user = User::query()->where('email', $email)->first();
                if ($user) {
                    if (Hash::check($password, $user->password)) {
                        $user-> find($user->id);
                        $user->auth_token = Str::random(60);
                        $user->save();
                        $cookie = cookie(self::AUTH, $user->auth_token, 60 * 24);
                        return redirect()->route('home')->withCookie($cookie)->with('success', 'Signed in.');
                    }
                }

            return redirect()->route('login')->with('success', 'Login details are not right.');
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function logout(Request $request): RedirectResponse {
        $auth_token = $request->cookie('auth_token');
        $cookie = cookie(self::AUTH, "");
        $user = User::query()->where('auth_token', $auth_token)->first();
        if($user) {
            $userId = $user->id;
            $user = User::query()-> find($userId);
            $user->auth_token = null;
            $user->save();
        }
        return redirect()->route('login')->withCookie($cookie);
    }
}
