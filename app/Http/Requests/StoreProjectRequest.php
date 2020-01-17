<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title'=> 'required|string|max:200',
            'client'=> 'required|string|max:200',
            'starting_date'=> 'required|date|after:today',
            'ending_date'=> 'nullable|date|after:starting_date',
            'users'=> 'required|array|min:1',
        ];
    }
}
