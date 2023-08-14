<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
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
            'image' => 'required',
            'name' => 'required|string',
            'location' => 'required|string',
            'city' => 'required|string',
            'delivery' => 'required',
            'pickup' => 'required',
            'whatsapp' => 'required',
            'description' => 'required',
            'price' => 'required',
            'rate' => 'required',
            // 'owner_id' => 'required|integer'
        ];
    }
}
