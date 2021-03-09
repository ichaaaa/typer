<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTyperRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('developer');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1',
            'competition_id' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:tomorrow',
            'visibility_type_id' => 'required|integer|min:1',
            'membership_fee_amount' => 'required|numeric|min:1',
            'membership_fee_currency' => 'required|regex:/[A-Z]{3}/',
            'awarded_positions' => 'required|integer|min:1',
            'status' => 'required|integer|min:0',

        ];
    }


    // public function attributes()
    // {
    //     return [
    //         'competition_id' => 'Rozgrywki',
    //     ];
    // }

    public function messages()
    {
        return [
            'required' => 'Pole jest wymagane.',
            'integer' => 'Niepoprawny format danych.',
            'numeric' => 'Niepoprawny format danych.',
            'regex' => 'Niepoprawny format danych.',
            'min' => 'Wartość nie może być niższa niż :min'
        ];
    }
}
