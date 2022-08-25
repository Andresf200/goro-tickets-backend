<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'identifier' => ['required', 'string', Rule::unique(Seller::class, 'identifier')],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'integer'],
            'address' => ['string', 'max:255'],
        ];
    }
}
