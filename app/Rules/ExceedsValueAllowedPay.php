<?php

namespace App\Rules;

use App\Models\Ticket;
use Illuminate\Contracts\Validation\Rule;

class ExceedsValueAllowedPay implements Rule
{

    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = Ticket::findOrFail($ticket);
    }


    public function passes($attribute, $value)
    {
        if ($this->ticket->remaining_amount < $value){
            return false;
        }
        return true;
    }

    public function message()
    {
        return "El monto a pagar excede el valor adeudado que es de $".$this->ticket->remaining_amount;
    }
}
