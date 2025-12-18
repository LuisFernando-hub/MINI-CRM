<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'status',
        'customer_id',
        'released_date',
        'response'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
