<?php

namespace App\Orchid\Screens\Companies;

use App\Models\Company;
use App\Orchid\Layouts\Companies\CompaniesEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CompaniesEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Companies details';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Companies manage';

    private $company;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $company = Company::whereSlug(Route::getCurrentRoute()->parameter('slug'))->firstOrFail();
        $this->company  = $company;
        return [
            'company' => $company
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->type(Color::DANGER())
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove'),

            /* Button::make(__('Save'))
                ->icon('check')
                ->method('save'), */
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::block(CompaniesEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__('Update companies account\'s profile information.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::SUCCESS())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    public function save(Request $request)
    {

        Validator::make($request->company, [
            "name" => ["required", 'min:3'],
            "about" => ["required", "min:20"],
            "email" => ["nullable", "email"],
            "phone" => ["nullable", "phone:AUTO,CM"],
            "phone2" => ["nullable", "phone:AUTO,CM"],
            "city_id" => ["required", "exists:cities,id"],
            "sub_sector_id" => ["required", "exists:sub_sectors,id"],
            "town" => ["required"],
            "facebook_url" => ["nullable", "url"],
            "twitter_url" => ["nullable", "url"],
            "instagram_url" => ["nullable", "url"],
            "youtube_url" => ["nullable", "url"],
            "linkedin_url" => ["nullable", "url"],
            "zip_code" => ["nullable"],
        ])->validate();

        $rCompany = $request->company;

        $company = Company::whereSlug(Route::getCurrentRoute()->parameter('slug'))->firstOrFail();

        $company->name = $rCompany['name'];
        $company->about = $rCompany['about'];
        $company->email = $rCompany['email'];
        $company->phone = $rCompany['phone'];
        $company->phone2 = $rCompany['phone2'];
        $company->city_id = $rCompany['city_id'];
        $company->sub_sector_id = $rCompany['sub_sector_id'];
        $company->town = $rCompany['town'];
        $company->facebook_url = $rCompany['facebook_url'];
        $company->twitter_url = $rCompany['twitter_url'];
        $company->instagram_url = $rCompany['instagram_url'];
        $company->youtube_url = $rCompany['youtube_url'];
        $company->linkedin_url = $rCompany['linkedin_url'];
        $company->zip_code = $rCompany['zip_code'];

        $company->save();

        Toast::info(__('Company was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        Company::whereSlug(Route::getCurrentRoute()->parameter('slug'))->delete();
        Toast::info(__('Company was removed'));

        return redirect()->route('platform.companies.all');
    }
}
