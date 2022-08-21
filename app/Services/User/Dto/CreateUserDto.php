<?php

namespace App\Services\User\Dto;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;


class CreateUserDto extends DataTransferObject {

    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(RegisterRequest $request): self
    {
        return new self(
            name: $request->getUserName(),
            email: $request->getUserEmail(),
            password: Hash::make($request->getUserPassword())
        );
    }
}
