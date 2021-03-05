<?php

namespace App\Orchid\Layouts\Subscriptions;

use App\Models\Company;
use App\Models\Plan;
use App\Models\Subscription;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SubscriptionsLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'subscriptions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('plan_id', __('Plan'))
                ->sort()
                ->cantHide()
                ->render(function (Subscription $subscription) {
                    return Plan::find($subscription->plan_id)->name;
                }),
            TD::make('plan_id', __('Price (XAF)'))
                ->sort()
                ->cantHide()
                ->render(function (Subscription $subscription) {
                    return Plan::find($subscription->plan_id)->price;
                }),
            TD::make('subscriber_id', __('Subscriber'))
                ->sort()
                ->cantHide()
                ->render(function (Subscription $subscription) {
                    $c = Company::find($subscription->subscriber_id);
                    return $c ? $c->name : "deleted";
                }),
            TD::make('starts_at', __('Start AT'))
                ->sort()
                ->cantHide()
                ->render(function (Subscription $subscription) {
                    return $subscription->starts_at;
                }),
            TD::make('ends_at', __('End AT'))
                ->sort()
                ->cantHide()
                ->render(function (Subscription $subscription) {
                    return $subscription->starts_at;
                }),
        ];
    }
}
