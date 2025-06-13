<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'sku'      => 'required|string|unique:products,sku,' . $this->product,
            'price'    => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ];
    }
}

