<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use App\Rules\ExceedsValueAllowedPay;
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
            'id_ticket' => ['required',Rule::exists(Ticket::class, 'id')],
            'mount' => [
                "required",
                "integer",
                new ExceedsValueAllowedPay($this->id_ticket)
            ]
        ];
    }
}
