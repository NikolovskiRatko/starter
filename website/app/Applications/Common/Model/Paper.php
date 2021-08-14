<?php

namespace App\Applications\Common\Model;

use App\Applications\Common\Model\Ratio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as MediaModel;

class Paper extends Model implements HasMedia
{
    use HasMediaTrait;
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $table = 'papers';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'display_name',
        'weight',
        'type',
        'price',
        'margin',
        'order'
    );

    /*
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'ratios',
        'media'
    ];

    public function ratios()
    {
        return $this->belongsToMany(Ratio::class,'paper_ratio');
    }
    public function registerMediaCollections()
    {
        $this->addMediaCollection('paper')
            ->singleFile();
    }

    public function registerMediaConversions(MediaModel $media = null)
    {
        $this->addMediaConversion('400')
            ->fit('max', 400, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('paper');

        $this->addMediaConversion('200')
            ->fit('max', 200, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('paper');
    }

    public function image()
    {
        return $this->media()->where('collection_name', 'paper');
    }
}
