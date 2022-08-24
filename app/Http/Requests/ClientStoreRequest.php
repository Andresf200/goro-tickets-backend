<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identifier' => ['required','string',Rule::unique(Client::class, 'identifier')],
            'name' => ['required','string'],
            'last_name' => ['required','string'],
            'phone' =>  ['required','integer'],
            'address' => ['string', 'max:255'],
        ];
    }
}
