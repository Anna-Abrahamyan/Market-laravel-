<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\User\Actions\CreateUserAction;
use App\Services\User\Dto\CreateUserDto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    const AUTH = 'auth_token';

    protected CreateUserAction $createUserAction;
    protected CreateUserDto $createUserDto;

    public function __construct(
        CreateUserAction $createUserAction,
        CreateUserDto $createUserDto)
    {
        $this->createUserAction = $createUserAction;
        $this->createUserDto = $createUserDto;

    }

    public function showRegister(): View {

        return view('register');
    }

    public function register(RegisterRequest $request): RedirectResponse {
        $dto = CreateUserDto::fromRequest($request);
        $this->createUserAction->run($dto);

        return redirect()->route('showLogin');
    }

    public function showLogin(): View {
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
                    return redirect()->route('home.index')->withCookie($cookie)->with('success', 'Signed in.');
                }
            }

            return redirect()->route('login')->with('success', 'Login details are not right.');
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function logout(LogoutRequest $request): RedirectResponse {
        $auth_token = $request->cookie('auth_token');
        $cookie = cookie(self::AUTH, "");
        $user = User::query()->where('auth_token', $auth_token)->first();
        if($user) {
            $userId = $user->id;
            $user = User::query()-> find($userId)->delete();
        }
        return redirect()->route('showLogin')->withCookie($cookie);
    }
}
