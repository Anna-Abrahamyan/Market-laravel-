<?php

namespace App\Models;

use App\Services\User\Dto\CreateUserDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'auth_token',
    ];

    public static function staticCreateUser(CreateUserDto $dto): User
    {
        $user = new static();
        $user->setUsername($dto->name);
        $user->setEmail($dto->email);
        $user->setPassword($dto->password);

        return $user;
    }

    public function setUserName(string $name): void
    {
        $this->$name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->$email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->$password = $password;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'user_product');
    }
}
