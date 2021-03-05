<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;
use Rinvex\Subscriptions\Models\PlanSubscription;

class Subscription extends PlanSubscription
{
    use HasFactory;
    use AsSource;
    use Chartable;
}
