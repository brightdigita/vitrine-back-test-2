<?php

namespace App\Orchid\Layouts\States;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StatesDetailsLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'cities';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
            /* ->render(function (User $user) {
                    return new Persona($user->presenter());
                }), */,
        ];
    }
}
