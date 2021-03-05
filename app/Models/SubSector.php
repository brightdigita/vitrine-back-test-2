<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
use Orchid\Screen\AsSource;

class SubSector extends Model
{
    use HasFactory;
    use Searchable;
    use AsSource;
    protected $guarded = ['id'];
    protected $hidden = [];
    protected $appends = ['companies_number'];
    protected $with = ['sector'];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public static function slug(String $name): String
    {
        $name = Str::slug($name);

        if (self::whereSlug($name)->first()) {
            return self::slug($name . "-" . random_int(0, 9));
        }
        return $name;
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function getCompaniesNumberAttribute()
    {
        return $this->companies()->count();
    }

    public function plan()
    {
        return $this->hasOne(Plan::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
