<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\Seller;
use App\Models\Ticket;
use App\Rules\UniqueArray;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'num_tickets.*' => [
                'string',
                'required',
                Rule::unique(Ticket::class, 'num_ticket')->ignore($this->route('ticket'))
            ],
            'price' => ['integer'],
            'id_seller' => ['required',Rule::exists(Seller::class, 'id')],
            'id_client' => [Rule::exists(Client::class, 'id')],
        ];
    }
}
