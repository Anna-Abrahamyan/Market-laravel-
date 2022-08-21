<?php

namespace App\Repository\Read\User;

use App\Models\User;

interface UserReadRepositoryInterface {
    public function getByEmail(User $user): User;
    public function getById(User $user): User;
}
