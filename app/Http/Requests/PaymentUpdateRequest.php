<?php

namespace App\Http\Requests;

use App\Models\Ticket;
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
            'mount' => ["numeric","between:0,800000.99",'max:800000'],
            'id_ticket' => [Rule::exists(Ticket::class, 'id')]
        ];
    }
}
