<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';
        return [
            'email' => $emailValidation,
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'phone' => 'required',
            'total_price' => 'required',
            'card_number' => 'required',
            'card_cvv' => 'required',
            'billing_name_on_card' => 'required',
            'card_month' => 'required',
            'card_year' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'You already have an account with this email address. Please <a href="/login">login</a> to continue.',
        ];
    }
}
