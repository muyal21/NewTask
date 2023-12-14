<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'amount',
        'admin_id'
    ];
}
