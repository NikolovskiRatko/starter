<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as MediaModel;

class Lamination extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'laminations';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'display_name',
        'price',
        'order'
    );

    protected $with = [
        'media'
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('laminations')
            ->singleFile();
    }

    public function registerMediaConversions(MediaModel $media = null)
    {
        $this->addMediaConversion('400')
            ->fit('max', 400, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('laminations');

        $this->addMediaConversion('200')
            ->fit('max', 200, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('laminations');
    }

    public function image()
    {
        return $this->media()->where('collection_name', 'laminations');
    }
}
