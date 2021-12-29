<?php

namespace GMJ\LaravelBlock2Video\Models;

use App\Models\Link;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Block extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    protected $guarded = [];
    protected $table = "laravel_block2_videos";
    public $translatable = ['text'];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection($this->table)->singleFile();
    }

    public function link()
    {
        return $this->morphOne(Link::class, 'linkable');
    }
}
