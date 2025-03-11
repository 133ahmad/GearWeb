<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;
    protected $table = 'mechanics'; 
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
        'experience',
        'rating',
    ];

     public function serviceRequests()
     {
         return $this->hasMany(ServiceRequest::class);
     }
}
