<?php

namespace App\Orchid\Layouts\Sectors;

use App\Models\Sector;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SectorsLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'sectors';

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
                ->render(function (Sector $user) {
                    return Link::make(__('Details'))
                        ->route('platform.sectors.show', $user->slug)
                        ->class('btn btn-primary py-2')
                        ->parameters([
                            'slug' => $user->slug
                        ])
                        ->icon('eye');
                }),
        ];
    }
}
