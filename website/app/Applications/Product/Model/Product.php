<?php

namespace App\Applications\Product\Model;

use App\Applications\Common\Model\Cliche;
use App\Applications\Common\Model\Color;
use App\Applications\Common\Model\Handle;
use App\Applications\Common\Model\Lamination;
use App\Applications\Common\Model\Paper;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = array(
        'name',
        'height',
        'width',
        'length',
        'handle_id',
        'lamination_id',
        'paper_id',
        'outside_spot_colors',
        'inside_spot_colors',
        'printed_bottom',
        'bottom',
        'front_back',
        'spot_uv',
        'hot_foil',
        'embossing',
        'quantity',
        'comment',
        'min_offer',
        'max_package_weight',
        'shipping_price',
        'original_product_id'
    );

    /*
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'paper',
        'handle',
        'lamination',
        'inside_colors',
        'outside_colors',
        'hot_foil_cliches',
        'embossing_cliches'
    ];

    protected $appends = [
        'handle_color_id'
    ];

    public function paper()
    {
        return $this->hasOne(Paper::class, 'id', 'paper_id');
    }

    public function handle()
    {
        return $this->hasOne(Handle::class, 'id', 'handle_id');
    }

    public function lamination()
    {
        return $this->hasOne(Lamination::class, 'id', 'lamination_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class,'product_color');
    }

    public function inside_colors()
    {
        return $this->colors()->wherePivot('type', 'inside');
    }

    public function outside_colors()
    {
        return $this->colors()->wherePivot('type', 'outside');
    }

    public function getHandleColorIdAttribute()
    {
        return $this->belongsToMany(Color::class,'product_color')->wherePivot('type', 'handle')->first()->id;
    }

    public function cliches()
    {
        return $this->hasMany(Cliche::class);
    }

    public function hot_foil_cliches()
    {
        return $this->hasMany(Cliche::class)->where('type', '=','hot_foil');
    }

    public function embossing_cliches()
    {
        return $this->hasMany(Cliche::class)->where('type', '=','embossing');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    public function scopeAuthorized($query, $id, $user_id){
        return $query->select(['offers.user_id'])->join('offers','offers.product_id','=','products.id')->where('products.id','=',$id)->where('offers.user_id', '=', $user_id);
    }

    public function image()
    {
        return $this->getFirstMedia('image');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }
}
