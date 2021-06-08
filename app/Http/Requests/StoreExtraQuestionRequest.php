<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExtraQuestionRequest extends FormRequest
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
            'description' => 'required|min:1',
            'helper' => 'required|min:1',
            'question_type_id' => 'required|integer|min:1',
            'answer.*' => 'required_if:question_type_id,2',
            'answer' => 'required_if:question_type_id,3',
        ];
    }
}
