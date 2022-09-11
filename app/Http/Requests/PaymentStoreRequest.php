<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_pay' => ['required','date'],
            'mount' => ["required","numeric","between:0,800000.99",'max:800000'],
            'id_ticket' => ['required',Rule::exists(Ticket::class, 'id')]
        ];
    }
}
