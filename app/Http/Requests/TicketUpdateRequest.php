<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\Seller;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'num_ticket' => ['integer', Rule::unique(Ticket::class, 'num_ticket')->ignore($this->route('ticket'))],
            'date_register' => ['date'],
            'price' => ['integer'],
            'id_seller' => [Rule::exists(Seller::class, 'id')],
            'id_client' => [Rule::exists(Client::class, 'id')],
        ];
    }
}
