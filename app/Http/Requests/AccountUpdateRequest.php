<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'nullable',
            'email' => ['email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
            'old_password' => 'nullable|required_with:password',
            'password' => 'nullable|confirmed|min:6|required_with:old_password',
        ];
    }
}
