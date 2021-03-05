<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Orchid\Screen\AsSource;

class State extends Model
{
    use HasFactory;
    use Searchable;
    use AsSource;
    protected $guarded = ['id'];
    protected $hidden = ['id'];
    protected $with = ['cities'];
    protected $appends = ['companies_number'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code
        ];
    }

    public function getCompaniesNumberAttribute()
    {
        $r = 0;
        $cities = City::with(['companies'])->whereStateId($this->id)->get();

        foreach ($cities as $city) {
            $r += $city->companies->count();
        }

        return $r;
    }

    public function scopePopularCompanies()
    {

        $companies = collect([]);
        $cities = City::with(['companies'])->whereStateId($this->id)->get();

        foreach ($cities as $city) {
            foreach ($city->companies as $company) {
                $companies->add($company);
            }
        }

        return $companies->take(6);
    }
}
