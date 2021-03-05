<?php

namespace App\Orchid\Layouts\Companies;

use App\Models\City;
use App\Models\SubSector;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class CompaniesEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('company.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            TextArea::make('company.about')
                ->title(__('About'))
                ->placeholder(__('About')),
            Select::make('company.sub_sector_id')
                ->fromModel(SubSector::class, 'name')
                ->required()
                ->title(__('Sub Sector'))
                ->placeholder(__('Sub Sector')),
            Input::make('company.email')
                ->type('email')
                ->title(__('Email'))
                ->placeholder(__('Email')),
            Input::make('company.phone')
                ->type('text')
                ->max(255)
                ->title(__('Phone'))
                ->placeholder(__('Phone')),
            Input::make('company.phone2')
                ->type('text')
                ->title(__('Whatsapp'))
                ->placeholder(__('Whatsapp')),
            Select::make('company.city_id')
                ->fromModel(City::class, 'name')
                ->required()
                ->title(__('City'))
                ->placeholder(__('City')),

            Input::make('company.town')
                ->type('text')
                ->required()
                ->title(__('Town'))
                ->placeholder(__('Town')),
            Input::make('company.zip_code')
                ->type('text')
                ->title(__('Zip Code'))
                ->placeholder(__('Zip Code')),
            Input::make('company.landmark')
                ->type('text')
                ->max(255)
                ->title(__('Landmark'))
                ->placeholder(__('Landmark')),
            Input::make('company.website')
                ->type('url')
                ->title(__('Website'))
                ->placeholder(__('Website')),
            Input::make('company.youtube_url')
                ->type('url')
                ->title(__('Youtube URL'))
                ->placeholder(__('Youtube URL')),
            Input::make('company.facebook_url')
                ->type('url')
                ->title(__('Facebook URL'))
                ->placeholder(__('Facebook URL')),
            Input::make('company.twitter_url')
                ->type('url')
                ->title(__('Twitter URL'))
                ->placeholder(__('Twitter URL')),
            Input::make('company.instagram_url')
                ->type('url')
                ->title(__('Instagram URL'))
                ->placeholder(__('Instagram URL')),
            Input::make('company.linkedin_url')
                ->type('url')
                ->title(__('LinkedIn URL'))
                ->placeholder(__('LinkedIn URL')),

        ];
    }
}
