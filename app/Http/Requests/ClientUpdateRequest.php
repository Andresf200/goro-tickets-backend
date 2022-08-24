<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identifier' => ['string', Rule::unique(Client::class, 'identifier')->ignore($this->route('client'))],
            'name' => ['string'],
            'last_name' => ['string'],
            'phone' => ['integer'],
            'address' => ['string', 'max:255'],
        ];
    }
}
