<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
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
            "name" => "required|string|min:4|max:50",
            "email" => "required|email|unique:users,email,$this->user,id",
            "phone" => "required|string|unique:users,phone,$this->user,id",
            "date_of_birth" => "required|date|date_format:Y-m-d",
            "password" => "required|min:6"
        ];
    }
}
