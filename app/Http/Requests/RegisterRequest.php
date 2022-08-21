<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    const USER_NAME = 'name';
    const USER_EMAIL = 'email';
    const USER_PASSWORD = 'password';
    const USER_TOKEN = 'authToken';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            self::USER_NAME  => 'required',
            self::USER_EMAIL => 'required|email|unique:users',
            self::USER_PASSWORD => 'required|min:8|max:20'
        ];
    }

    public function getUserName():string {
        return $this->get(self::USER_NAME);
    }

    public function getUserEmail(): string
    {
        return $this->get(self::USER_EMAIL);
    }

    public function getUserPassword(): string
    {
        return $this->get(self::USER_PASSWORD);
    }
}
