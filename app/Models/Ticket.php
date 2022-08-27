<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'num_ticket',
        'date_register',
        'price',
        'remaining_amount',
        'id_seller',
        'id_client',
    ];

    //boleta tiene cliente ya fue vendida

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class,'id_client');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Client::class,'id_seller');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'id_ticket');
    }
}
