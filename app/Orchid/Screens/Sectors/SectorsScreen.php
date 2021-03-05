<?php

namespace App\Orchid\Screens\Sectors;

use App\Models\Sector;
use App\Orchid\Layouts\Sectors\SectorsLayout;
use Orchid\Screen\Screen;

class SectorsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Sectors';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All sectors available on database';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'sectors' => Sector::with('subSectors')->paginate()
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
            SectorsLayout::class
        ];
    }
}
