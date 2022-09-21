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
        'id_ticket',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class,'id_ticket');
    }

}
