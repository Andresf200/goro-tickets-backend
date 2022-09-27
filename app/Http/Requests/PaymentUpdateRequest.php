<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use App\Rules\ExceedsValueAllowedPay;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_pay' => ['date'],
            'id_ticket' => [Rule::exists(Ticket::class, 'id')],
            'mount' => [
                "required",
                "integer",
                new ExceedsValueAllowedPay($this->id_ticket)
            ],

        ];
    }
}
