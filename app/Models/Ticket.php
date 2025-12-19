<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Ticket",
 *     title="Ticket",
 *     description="Ticket model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="subject", type="string", example="Fix login bug"),
 *     @OA\Property(property="description", type="string", example="Fix login bug"),
 *     @OA\Property(property="status", type="enum", example="new,in_progress,processed"),
 *     @OA\Property(property="customer_id", type="integer", example=1),
 *     @OA\Property(property="released_date", type="string", format="date", example="2025-12-18"),
 *     @OA\Property(property="response", type="string", example="Resolved fix login")
 * )
 */
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
