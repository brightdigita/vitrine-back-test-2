<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends \Rinvex\Subscriptions\Models\Plan
{
    use HasFactory;

    public static function slug(String $name): String
    {
        if (self::whereSlug($name)->first()) {
            return self::slug($name . "-" . random_int(0, 9));
        }
        return Str::slug($name);
    }
}
