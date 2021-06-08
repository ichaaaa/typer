<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:100',
            'roles' => 'required',
            'permissions' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Pole jest wymagane.',
            'min' => 'Wartość nie może być niższa niż :min'
        ];
    }

}
