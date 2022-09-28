<?php

namespace App\Rules;

use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Contracts\Validation\Rule;

class ExceedsValueAllowedPay implements Rule
{

    protected $ticket;
    protected int $reaming_amount;
    private $message;

    public function __construct($ticket)
    {
        $this->ticket = Ticket::findOrFail($ticket);
    }


    public function passes($attribute, $value)
    {
        $this->reaming_amount = Payment::REAMING_AMOUNT - $this->ticket->payments->sum('mount');
        if (intval($value) <= $this->reaming_amount){
            if (intval($value) == 0){
                $this->message = "El valor total de la boleta ya ha sido cancelado revise el listado de pagos de esta boleta
                 para verificar";
                return false;
            }
            return true;
        }
        $this->message = "El monto a pagar excede el valor adeudado que es de $".$this->reaming_amount;
        return false;
    }

    public function message()
    {
        return $this->message;
    }
}
