<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaundryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'claim_code' => 'required',
            'shop_id' => 'required',
            'weight' => 'required',
            'with_pickup' => 'required',
            'with_delivery' => 'required',
            'pickup_address' => 'required',
            'delivery_address' => 'required',
            'total' => 'required',
            'description' => 'required',
            'status' => 'required',
            'user_id' => 'required'
        ];
    }
}
