<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_superuser;
        //return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|string|max:100',
            'userid'=> 'required|string|max:20|unique:users,userid',
            'email'=> 'required|string|email|max:200',
            'designation'=> 'string|max:100',
            'is_active'=> 'numeric',
            'roles'=> 'required|array|min:1',
        ];
    }
}
