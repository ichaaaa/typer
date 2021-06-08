<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBannedUserRequest extends FormRequest
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
            'banning-reason' => 'required|min:5|max:100'
        ];
    }


    public function messages()
    {
        return [
            'required' => 'Pole jest wymagane.',
            'min' => 'Wiadomość musi być dłuższa.',
            'max' => 'Wartość musi być krótsza.',
        ];
    }
}
