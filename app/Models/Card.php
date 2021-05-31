<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Card extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'subject_id',
        'front',
        'back',
        'front_content',
        'back_content',
        'num_of_study',
        'level_of_card',
        'expiry_date'
    ];

    // Relation
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function sharedSubject()
    {
        return $this->belongsTo(SharedSubject::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300);
    }
}
