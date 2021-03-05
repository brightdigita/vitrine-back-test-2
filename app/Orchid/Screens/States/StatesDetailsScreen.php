<?php

namespace App\Orchid\Screens\States;

use App\Models\State;
use App\Orchid\Layouts\States\StatesDetailsLayout;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Screen;

class StatesDetailsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'States details';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Details of states';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $state = State::with('cities')->whereCode(Route::getCurrentRoute()->parameter('slug'))->firstOrFail();
        $this->description = $state->name;
        return [
            'state' => $state,
            'cities' => $state->cities
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
            StatesDetailsLayout::class,
        ];
    }
}
