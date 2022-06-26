<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestroyUserRequest extends FormRequest
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
            "email" => ["Min:5", "Max:100", "Email", "required"],
            "password" => ["Min:5", "Max:30", "required"],
        ];
    }
}
