<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

/**
 * @OA\Schema(
 *     schema="Customer",
 *     title="Customer",
 *     description="Customer model",
 *     @OA\Property(property="name", type="string", example="Make"),
 *     @OA\Property(property="email", type="string", example="make@gmail.com"),
 *     @OA\Property(property="phone_number", type="integer", example=119999999),
 * )
 */
class Customer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    protected $fillable = [
        'name',
        'email',
        'phone_number',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documents')->useDisk('public');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getDocumentsAttribute(): Collection
    {
        return $this->getMedia('documents')->map(fn($media) => [
            'file_name' => $media->file_name,
            'url' => $media->getUrl(),
            'open' => false,
        ])->values();
    }
}
