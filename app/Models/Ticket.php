<?php

namespace App\Models;

use App\Enums\TicketStatus;
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

    protected $casts = [
        'status' => TicketStatus::class,
    ];

    public function getReadableStatusAttribute(): string
    {
        if ($this->status instanceof TicketStatus) {
            return $this->status->getReadableName();
        }

        return TicketStatus::from($this->status)->getReadableName();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
