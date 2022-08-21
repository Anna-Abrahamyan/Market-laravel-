<?php

namespace App\Repository\Write\User;

use App\Models\User;
use Illuminate\Support\Str;

class UserWriteRepository implements UserWriteRepositoryInterface {

    public function save(User $user): User
    {
        $user->save();
        return $user;
    }

    public function addAuthToken(User $user): User
    {
        $user->auth_token = Str::random(60);
        $user->save();
        return $user;
    }

    public function deleteAuthToken(User $user): User
    {
        $user = $user::query()-> find($user->id)->delete();
        return $user;
    }
}
