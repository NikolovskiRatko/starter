<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as MediaModel;

class Combination extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'combinations';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'width',
        'length',
        'height',
        'order',
        'active'
    );

    protected $with = [
        'media',
        'image'
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('bag_sizes')
            ->singleFile();
    }

    public function registerMediaConversions(MediaModel $media = null)
    {
        $this->addMediaConversion('400')
            ->fit('max', 400, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('bag_sizes');

        $this->addMediaConversion('200')
            ->fit('max', 200, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('bag_sizes');

        $this->addMediaConversion('100')
            ->fit('max', 100, 100)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('bag_sizes');
    }

    public function image()
    {
        return $this->media()->where('collection_name', 'bag_sizes');
    }
}
