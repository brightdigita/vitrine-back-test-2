<?php

namespace App\Orchid\Screens\Sectors;

use App\Models\Sector;
use App\Orchid\Layouts\Sectors\SectorsDetailsLayout;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Screen;

class SectorsDetailsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Sectors details';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Details of sectors';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $sector = Sector::with('subSectors')->whereSlug(Route::getCurrentRoute()->parameter('slug'))->firstOrFail();
        $this->description = $sector->name;
        return [
            'sector' => $sector,
            'sub_sectors' => $sector->subSectors
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
            SectorsDetailsLayout::class
        ];
    }
}
