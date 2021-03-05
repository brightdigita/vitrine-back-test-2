<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Rinvex\Subscriptions\Traits\HasSubscriptions;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
use Multicaret\Acquaintances\Traits\Friendable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Company extends Model
{
    use HasFactory;
    use HasSubscriptions;
    use Searchable;
    use Friendable;
    use AsSource;
    use Chartable;
    protected $guarded = ["id"];
    protected $with = ["city", 'subSector', 'posts'];
    protected $appends = ["active_subscription", 'views', 'sponsorships'];
    public $asYouType = true;
    protected $primaryKey = 'id';

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->title,
            'details' => $this->description
        ];
    }

    public function getSponsorshipsAttribute()
    {
        return
            $this->getAllFriendships();
    }

    public static function slug(String $name): String
    {
        $name = Str::slug($name);
        if (self::whereSlug($name)->first()) {
            return self::slug($name . "-" . random_int(0, 9));
        }
        return $name;
    }



    public function activeSubscription()
    {
        return $this->subscription('main');
    }

    public function getHasPromotionAttribute()
    {
        return $this->subscription('main');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getActiveSubscriptionAttribute()
    {
        //return;
        return $this->subscription("main");
    }

    public function subSector()
    {
        return $this->belongsTo(SubSector::class);
    }

    public function opens()
    {
        return $this->hasMany(CompanyView::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy("created_at", 'DESC');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getBackdropAttribute($value)
    {
        return $value ? Storage::disk(config("filesystems.default"))->url($value) : $value;
    }

    public function getPosterAttribute($value)
    {
        return $value ? Storage::disk(config("filesystems.default"))->url($value) : $value;
    }

    public function getViewsAttribute()
    {
        return $this->opens()->count();
    }
}
