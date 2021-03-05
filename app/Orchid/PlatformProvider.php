<?php

namespace App\Orchid;

use App\Models\City;
use App\Models\Company;
use App\Models\Sector;
use App\Models\State;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [
            ItemMenu::label('Companies')
                ->icon('building')
                ->route('platform.companies.all'),
            ItemMenu::label('Subscriptions')
                ->icon('rocket')
                ->route('platform.subscriptions.all'),

            ItemMenu::label('Sectors')
                ->title('Dummies data')
                ->icon('briefcase')
                ->route('platform.sectors.all'),

            ItemMenu::label('States')
                ->icon('globe')
                ->route('platform.states.all'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            /* Company::class,
            Sector::class,
            State::class,
            City::class, */];
    }
}
