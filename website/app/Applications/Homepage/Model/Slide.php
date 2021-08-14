<?php

namespace App\Applications\Homepage\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as MediaModel;

class Slide extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'sliders';
    public $timestamps = true;

    protected $casts = [
        'learn_more_link_custom' => 'boolean',
        'get_started_link_custom' => 'boolean',
    ];

    protected $with = [
        'media'
    ];

    protected $fillable = array(
        'title',
        'subtitle',
        'description',
        'type',
        'image',
        'learn_more_text',
        'learn_more_link',
        'learn_more_color',
        'get_started_text',
        'get_started_link',
        'get_started_color',
        'learn_more_link_custom',
        'get_started_link_custom',
    );

    public function registerMediaCollections()
    {
        $this->addMediaCollection('slider_images')
            ->singleFile();
    }

    public function registerMediaConversions(MediaModel $media = null)
    {
        $this->addMediaConversion('1920')
            ->fit('max', 1920, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('slider_images');

        $this->addMediaConversion('1280')
            ->fit('max', 1280, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('slider_images');
    }

    public function image()
    {
        return $this->getFirstMedia('slider_images');
    }
}
