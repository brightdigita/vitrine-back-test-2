<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\City;
use App\Models\Company;
use App\Models\Sector;
use App\Models\State;
use App\Models\Subscription;
use App\Models\SubSector;
use App\Orchid\Layouts\DashboardChart;
use App\Orchid\Layouts\DashboardMetric;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Welcome';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Welcome to your Dashboard.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'metrics' => [
                ['keyValue' => Company::get()->count(),],
                ['keyValue' => Subscription::get()->count(),],
                ['keyValue' => Sector::get()->count(),],
                ['keyValue' => SubSector::get()->count(),],
                ['keyValue' => State::get()->count(),],
                ['keyValue' => City::get()->count(),],
            ],
            'charts' => [
                Company::countByDays()->toChart('Companies'),
                Subscription::countByDays()->toChart('Subscriptions'),
            ]
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Website')
                ->href('http://vitrine237.cm')
                ->target('blank')
                ->icon('globe-alt'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            DashboardMetric::class,
            DashboardChart::class
        ];
    }
}
