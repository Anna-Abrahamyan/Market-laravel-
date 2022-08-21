<?php

namespace App\Repository\Write\User;

use App\Models\User;

interface UserWriteRepositoryInterface {
    public function save(User $user): User;
    public function addAuthToken(User $user): User;
    public function deleteAuthToken(User $user): User;
}
