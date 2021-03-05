<?php

namespace App\Orchid\Screens\Subscriptions;

use App\Models\Subscription;
use App\Orchid\Layouts\Subscriptions\SubscriptionsLayout;
use Orchid\Screen\Screen;

class SubscriptionsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Subscriptions';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All subscriptions';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'subscriptions' => Subscription::all()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            SubscriptionsLayout::class
        ];
    }
}
