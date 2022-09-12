<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sellers';

    protected $fillable = [
        'identifier',
        'name',
        'last_name',
        'phone',
        'address'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'id_seller');
    }

}
