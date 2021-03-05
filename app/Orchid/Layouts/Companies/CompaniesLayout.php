<?php

namespace App\Orchid\Layouts\Companies;

use App\Models\Company;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CompaniesLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'companies';

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
            /* ->render(function (User $user) {
                    return new Persona($user->presenter());
                }), */,
            TD::make('email', __('Email'))
                ->sort()
                ->cantHide(),
            TD::make('city', __('City'))
                ->sort()
                ->cantHide()
                ->render(function (Company $user) {
                    return $user->city->name;
                }),
            TD::make('subSector', __('Sub Sector'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Company $user) {
                    return $user->subSector->name;
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Company $user) {
                    return Link::make(__('Details'))
                        ->route('platform.companies.show', $user->slug)
                        ->class('btn btn-primary py-2')
                        ->parameters([
                            'slug' => $user->slug
                        ])
                        ->icon('eye');
                }),
        ];
    }
}
