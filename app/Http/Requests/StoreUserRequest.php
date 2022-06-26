<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "name" => ["Min:5", "Max:30", "required"],
            "email" => ["Min:5", "Max:100", "Email", "Unique:App\Models\User,email", "required"],
            "password" => ["Min:5", "Max:30", "required"],
            "avatar" => ["ends_with:.jpg,.png"],
            "twitter" => ["Min:5", "Max:30", "starts_with:@"],
            "description" => ["Min: 10", "Max:200"],
        ];
    }

    /**
     * Get custom messages for validator errors.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            "avatar.ends_with" => "The avatar must be an .png of .jpg file",
            "twitter.starts_with" => "The Twitter must be an valid account"
        ];
    }
}
