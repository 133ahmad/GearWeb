<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'type',
        'status',
        'customer_id',
        'mechanic_id',
        'accepted_at',
        'scheduled_date'
    ];
}
