<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'RegistrationDate',
        'status',
    ];

    public function serviceRequests()
    {
         return $this->hasMany(ServiceRequest::class);
     }
}
