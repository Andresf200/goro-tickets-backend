<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'date_pay',
        'mount',
        'remaining_amount',
        'id_ticket',
    ];

    const REAMING_AMOUNT = 35000;

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class,'id_ticket');
    }

    public function getRemainingAmountAttribute($mount)
    {
        $ticket = Ticket::findOrFail($this->id_ticket);
        $valueTotal =$ticket->payments->where('date_pay', '<=', $this->date_pay)->where('created_at','<=',$this->created_at)->sum('mount');
        return self::REAMING_AMOUNT - $valueTotal;
    }

}
