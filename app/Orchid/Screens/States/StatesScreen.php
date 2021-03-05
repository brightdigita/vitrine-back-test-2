<?php

namespace App\Orchid\Screens\States;

use App\Models\State;
use App\Orchid\Layouts\States\StatesLayout;
use Orchid\Screen\Screen;

class StatesScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'States';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of states';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'states' => State::paginate()
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
            StatesLayout::class
        ];
    }
}
