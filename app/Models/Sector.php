<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
use Orchid\Screen\AsSource;

class Sector extends Model
{
    use AsSource;
    protected $guarded = ['id'];
    protected $hidden = [];
    protected $appends = ['companies_number'];

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

    public function subSectors()
    {
        return $this->hasMany(SubSector::class);
    }

    public function getCompaniesNumberAttribute()
    {
        $r = 0;
        $subSectors = SubSector::with(['companies'])->whereSectorId($this->id)->get();

        foreach ($subSectors  as $subSector) {
            $r += $subSector->companies->count();
        }

        return $r;
    }
}
