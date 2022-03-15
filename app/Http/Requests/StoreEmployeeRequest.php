<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|min:2|max:256',
            // 'patronymic' => 'nullable|min:3|max:100',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:8|max:50',
            // 'confirm' => 'required_with:password|same:password',
            // 'role' => 'required',
            // 'manager_id' => 'nullable',
            // 'phone' => ['required', 'regex:/\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}|\(_{3}\)\s_{3}-_{2}-_{2}/'],
            // 'city' => 'nullable|max:50',
            // 'address' => 'nullable|max:100',
        ];
    }
}
