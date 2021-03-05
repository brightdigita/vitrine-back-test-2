<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubSectorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// auth
Route::group(['middleware' => ['auth:sanctum'],], function () {
    Route::post('user', [ProfileController::class, 'update']);
    Route::post('user/password', [ProfileController::class, 'password']);

    Route::post('verify', [VerificationController::class, 'verify']);
    Route::post('resend', [VerificationController::class, 'resend']);

    Route::post("companies", [CompanyController::class, 'store'])->middleware("company.registered");
    Route::post("companies/update", [CompanyController::class, 'update']);
    Route::post("companies/subscribe", [TransactionController::class, 'store'])->middleware("company.unregistered");
    Route::get("companies/all", [CompanyController::class, 'all']);
    Route::post("uploads/poster", [UploadController::class, 'poster']);
    Route::post("uploads/backdrop", [UploadController::class, 'backdrop']);
    Route::post("uploads/post", [UploadController::class, 'post']);

    ROute::get("sponsors", [SponsorshipController::class, 'index']);
    ROute::get("insight", function () {
        $posts = auth()->user()->company->posts;
        $messages = auth()->user()->company->messages;
        $promotions = auth()->user()->company->promotions;
        $views = auth()->user()->company->views;
        return response()->json(compact('posts', 'messages', 'promotions', 'views'));
    });

    Route::post("posts", [PostController::class, 'store']);
    Route::post("posts/{slug}", [PostController::class, 'update']);
    Route::delete("posts/{slug}", [PostController::class, 'destroy']);
    Route::get("posts/owner", [PostController::class, 'owner']);
});

// guest
Route::group(['middleware' => ['guest:sanctum'],], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('password/request', [ForgotPasswordController::class, 'sendResetCode']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);
});

Route::get("search", [SearchController::class, 'index']);
Route::get("companies", [CompanyController::class, 'index']);
Route::get("companies/popular", [CompanyController::class, 'popular']);
Route::get("companies/trending", [CompanyController::class, 'trending']);
Route::get("companies/latest", [CompanyController::class, 'latest']);
Route::get("companies/{slug}", [CompanyController::class, 'show']);
Route::post("companies/{slug}/messages", [CompanyController::class, 'message']);

//states
Route::get("states", [StateController::class, 'index']);
Route::get("states/popular", [StateController::class, 'popular']);
Route::get("states/{slug}", [StateController::class, 'show']);
Route::get("states/{slug}/companies", [StateController::class, 'companies']);

//posts
Route::get("posts", [PostController::class, 'index']);
Route::get("posts/{slug}", [PostController::class, 'show']);

//cities
Route::get("cities", [CityController::class, 'index']);
Route::get("cities/find", [CityController::class, 'find']);
Route::get("cities/popular", [CityController::class, 'popular']);
Route::get("cities/{slug}", [CityController::class, 'show']);

//sub-sectors
Route::get("sub-sectors", [SubSectorController::class, 'index']);
Route::get("sub-sectors/popular", [SubSectorController::class, 'popular']);
Route::get("sub-sectors/{slug}", [SubSectorController::class, 'show']);

//categories
Route::get("categories", [SectorController::class, 'index']);
Route::get("categories/popular", [SectorController::class, 'popular']);
Route::get("categories/{slug}", [SectorController::class, 'show']);
Route::get("categories/{slug}/companies", [SectorController::class, 'showCompanies']);

Route::get("plans", function () {
    return response()->json(app('rinvex.subscriptions.plan')->get());
});

Route::get("subscriptions/callback", [TransactionController::class, 'handle']);
