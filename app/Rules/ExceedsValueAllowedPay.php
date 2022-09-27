<?php

namespace App\Rules;

use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Contracts\Validation\Rule;

class ExceedsValueAllowedPay implements Rule
{

    protected $ticket;
    protected int $reaming_amount;

    public function __construct($ticket)
    {
        $this->ticket = Ticket::findOrFail($ticket);
    }


    public function passes($attribute, $value)
    {
        $this->reaming_amount = Payment::REAMING_AMOUNT - $this->ticket->payments->sum('mount');
        if ($this->reaming_amount <= $value){
            return false;
        }
        return true;
    }

    public function message()
    {
        return "El monto a pagar excede el valor adeudado que es de $".$this->reaming_amount;
    }
}
