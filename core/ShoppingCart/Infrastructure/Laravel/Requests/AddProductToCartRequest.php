<?php

namespace Core\ShoppingCart\Infrastructure\Laravel\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddProductToCartRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cartId' => 'required|integer|exists:shopping_carts,id',
            'productId' => 'required|integer',
            'quantity' => 'required|integer|gt:0',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'cartId' => $this->route('cartId'),
            'productId' => $this->route('productId'),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}