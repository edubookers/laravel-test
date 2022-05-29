<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomer extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            [
                'email'       => 'required|email',
                'first_name'  => 'required|max:20',
                'last_name'   => 'max:20|nullable',
                'password'    => 'required|min:8',
                'password_re' => 'same:password'
            ]
        ];
    }
}
