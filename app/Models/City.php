<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Orchid\Screen\AsSource;

class City extends Model
{
    use HasFactory;
    use Searchable;
    use AsSource;
    protected $guarded = ['id'];
    protected $hidden = [];
    protected $appends = ['companies_number'];
    protected $table = "cities";

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public static function slug(String $name): String
    {
        if (self::whereSlug($name)->first()) {
            return self::slug($name . "-" . random_int(0, 9));
        }
        return $name;
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
        //return $this->hasMany(Company::class)->take(10);
    }

    public function getCompaniesNumberAttribute()
    {
        return $this->companies()->count();
    }
}
