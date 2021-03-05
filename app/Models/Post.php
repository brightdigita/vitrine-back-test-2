<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $white = ['promote'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getPosterAttribute($value)
    {
        return $value ? Storage::disk(config("filesystems.default"))->url($value, now()->addDays(5)) : $value;
    }

    public static function slug()
    {
        $r = Str::random(9);

        if (self::whereSlug($r)->first()) {
            return self::slug();
        }

        return $r;
    }

    public function promote()
    {
        return $this->hasOne(Promote::class);
    }
}
