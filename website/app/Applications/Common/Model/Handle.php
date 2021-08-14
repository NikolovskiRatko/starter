<?php

namespace App\Applications\Common\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as MediaModel;

class Handle extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'handles';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'display_name',
        'fold',
        'width',
        'height',
        'length',
        'tying',
        'price',
        'order'
    );

    protected $with = [
        'image',
        'colors',
        'media'
    ];

    public function colors()
    {
        return $this->belongsToMany(Color::class,'handle_color');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('handles')
            ->singleFile();
    }

    public function registerMediaConversions(MediaModel $media = null)
    {
        $this->addMediaConversion('400')
            ->fit('max', 400, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('handles');

        $this->addMediaConversion('200')
            ->fit('max', 200, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('handles');

        $this->addMediaConversion('100')
            ->fit('max', 100, 100)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('handles');
    }

    public function image()
    {
        return $this->media()->where('collection_name', 'handles');
    }
}
