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
            'image' => 'required|image|mimes:jpg,png|max:5120|dimensions:min_width=300,min_height=300',
            'name' => 'required|min:2|max:256',
            'phone' => ['required', 'regex:/\+380[0-9]{9}/'],
            'email' => 'required|email|unique:users,email',
            'position_id' => 'required',
            'salary' => 'required|min:0|max:500',
            'head' => 'sometimes',
            'head_id' => 'required_with:head',
            'date_of_employment' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'Photo',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'position_id' => 'Position',
            'salary' => 'Salary, $',
            'head' => 'Head',
            'head_id' => 'Head Id',
            'date_of_employment' => 'Date of employment',
        ];
    }
}
