<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required',
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'sku' => 'required|string',
            'status' => 'required',
            'description' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori wajib diisi.',
            'product_name.required' => 'Produk wajib diisi.',
            'product_name.string' => 'Produk hanya boleh huruf dan angka.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga hanya boleh diisi dengan angka.',
            'sku.required' => 'SKU wajib diisi.',
            'sku.string' => 'Produk hanya boleh huruf dan angka.',
            'status.required' => 'Status wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.string' => 'Deskripsi hanya boleh huruf dan angka.',
            'image.mimes' => 'Gambar hanya boleh berformat jpg, jpeg, png atau gif'
        ];
    }
}
