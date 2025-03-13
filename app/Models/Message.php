<?php

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Mechanic;

class Message extends Model
{
    protected $fillable = ['customer_id', 'mechanic_id', 'message', 'is_read'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}

