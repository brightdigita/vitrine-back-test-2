<?php

declare(strict_types=1);

use App\Orchid\Layouts\User\UserListLayout;
use App\Orchid\Screens\Companies\CompaniesEditScreen;
use App\Orchid\Screens\Companies\CompaniesScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Sectors\SectorsDetailsScreen;
use App\Orchid\Screens\Sectors\SectorsScreen;
use App\Orchid\Screens\States\StatesDetailsScreen;
use App\Orchid\Screens\States\StatesScreen;
use App\Orchid\Screens\Subscriptions\SubscriptionsScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

Route::screen('subscriptions', SubscriptionsScreen::class)->name('platform.subscriptions.all');
Route::screen('companies', CompaniesScreen::class)->name('platform.companies.all');
Route::screen('companies/{slug}/manage', CompaniesEditScreen::class)->name('platform.companies.show');
Route::screen('sectors', SectorsScreen::class)->name('platform.sectors.all');
Route::screen('sectors/{slug}/manage', SectorsDetailsScreen::class)->name('platform.sectors.show');
Route::screen('states', StatesScreen::class)->name('platform.states.all');
Route::screen('states/{slug}/manage', StatesDetailsScreen::class)->name('platform.states.show');
