<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    const USER_NAME = 'name';
    const USER_EMAIL = 'email';
    const USER_PASSWORD = 'password';
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
            self::USER_EMAIL => 'required|email',
            self::USER_PASSWORD => 'required|min:8|max:20'
        ];
    }
}
