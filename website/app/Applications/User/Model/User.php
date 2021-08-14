<?php

namespace App\Applications\User\Model;


//use App\Applications\Product\Model\Offer;
//use App\Applications\Product\Model\Product;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as MediaModel;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Webpatser\Countries\Countries;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements JWTSubject, HasMedia
{
    use Notifiable;
    use HasMediaTrait;
    use EntrustUserTrait { restore as private restoreEntrust; }
    use SoftDeletes { restore as private restoreSoftDelete; }

    protected $appends = [
        'home_path',
//        'bagCount'
    ];

    protected $with = [
        'country',
        'shipping_details',
        'billing_details',
        'media'
    ];

    protected $casts = [
        'type_id' => 'integer',
    ];

    protected $fillable = [
        'username',
        'phone',
        'company',
        'first_name',
        'last_name',
        'email',
        'contact_email',
        'password',
        'country_id',
        'is_disabled',
        'source',
        'source_info',
        'activation_code'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    public function restore(){
        $this->restoreEntrust();
        $this->restoreSoftDelete();
    }

//    public function offers()
//    {
//        return $this->belongsToMany(Offer::class,'offers');
//    }

//    public function getBagCountAttribute()
//    {
//        return $this->hasMany(Offer::class)->doesntHave('order')->count();
//    }

    public function shipping_details()
    {
        return $this->hasOne(Details::class, 'user_id', 'id')->where('default', true)->where('type', '=','SHIPPING');
    }

    public function billing_details()
    {
        return $this->hasOne(Details::class, 'user_id', 'id')->where('default', true)->where('type', '=','BILLING');
    }

    public function isAdmin()
    {
        return $this->roles()->pluck('id')->contains(1); // We need to take this function off
    }

    public function isPublic()
    {
        return $this->roles()->pluck('id')->contains(3);
    }

    public function isNormal()
    {
        return !$this->roles()->pluck('id')->contains(1);
    }

    public function getTypeText()
    {
        switch ($this->roles()->pluck('id')) {
            case 1:
            return __('strings.admin');
            case 2:
            return __('strings.normal');
            case 3:
            return __('strings.public');
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    public function roles_array()
    {
        return $this->roles()->allRelatedIds()->toArray();
    }

    public function permissions_array(){
        $permissions = [];
        foreach($this->roles as $role){
            $permissions = array_unique(array_merge($permissions, $role->permissions->pluck('name')->toArray()));
        }
        return $permissions;
    }

    public function getHomePathAttribute()
    {
        // TODO: Manage this properly
        return '/';
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('user_avatars')
            ->singleFile();
    }

    public function registerMediaConversions(MediaModel $media = null)
    {
        $this->addMediaConversion('400')
            ->fit('max', 400, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('user_avatars');

        $this->addMediaConversion('200')
            ->fit('max', 200, 0)
            ->optimize()->keepOriginalImageFormat()
            ->performOnCollections('user_avatars');
    }

    public function image()
    {
        return $this->getFirstMedia('user_avatars');
    }

}
