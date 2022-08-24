<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
