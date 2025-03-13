<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceRequest;
use App\Models\Appointment;
use App\Models\Message;
use Message as GlobalMessage;

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
        'latitude', 
        'longitude',
    ];

     public function serviceRequests()
     {
         return $this->hasMany(ServiceRequest::class);
     }
     public function appointments()
{
    return $this->hasMany(Appointment::class);
}
public function messages()
{
    return $this->hasMany(Message::class);
}


}
