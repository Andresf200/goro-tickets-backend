<?php

namespace App\Http\Requests;

use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'identifier' => ['string', Rule::unique(Seller::class, 'identifier')->ignore($this->route('seller'))],
            'name' => ['string'],
            'last_name' => ['string'],
            'phone' => ['integer'],
            'address' => ['string', 'max:255'],
        ];
    }
}
