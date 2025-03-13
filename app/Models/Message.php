<?php
  namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

