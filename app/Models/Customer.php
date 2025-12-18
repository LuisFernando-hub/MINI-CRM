<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

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
