<?php

namespace App\Orchid\Layouts\States;

use App\Models\State;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StatesLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'states';

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

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (State $user) {
                    return Link::make(__('Details'))
                        ->route('platform.states.show', $user->code)
                        ->class('btn btn-primary py-2')
                        ->parameters([
                            'slug' => $user->code
                        ])
                        ->icon('eye');
                }),
        ];
    }
}
