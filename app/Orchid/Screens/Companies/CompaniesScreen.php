<?php

namespace App\Orchid\Screens\Companies;

use App\Models\Company;
use App\Orchid\Layouts\Companies\CompaniesLayout;
use Orchid\Screen\Screen;

class CompaniesScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Companies';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All registered users';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'companies' => Company::paginate()
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
            CompaniesLayout::class
        ];
    }
}
