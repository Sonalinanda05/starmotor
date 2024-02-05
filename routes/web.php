<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\BookCarsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/view/cars', [HomeController::class, 'viewCars'])->name('user.view.cars');
Route::get('cars/sorting',[HomeController::class, 'sortCars'])->name('car.sort');
Route::get('cars/search',[HomeController::class, 'searchCars'])->name('car.search');
Route::get('/view/carsDetails/{id}', [HomeController::class, 'viewCarsDetails'])->name('users.car.details');
Route::get('/aboutUs',[HomeController::class, 'aboutUs'])->name('car.aboutUs');
Route::get('/byModel/{modelName}',[HomeController::class, 'ByModel'])->name('car.model');
Route::get('/byPrice/{priceRange}',[HomeController::class, 'ByPrice'])->name('car.Price');
Route::get('/byBodyType/{body_types}',[HomeController::class, 'ByBodyType'])->name('car.BodyType');
Route::get('/byFuelType/{fuel_types}',[HomeController::class, 'ByFuelType'])->name('car.FuelType');
Route::get('cars/filterCars',[HomeController::class, 'filterCars'])->name('car.filter');
Route::get('/cars/{id}',[HomeController::class, 'showDetails'])->name('car.details');
Route::get('/sell/cars', [HomeController::class, 'sellCars'])->name('user.sell.cars');
Route::post('/sell/cars/store', [HomeController::class, 'sellCarsStore'])->name('user.sell.carStore');

//contact us
 Route::get('contact/create', [HomeController::class, 'contactCreate'])->name('contact.create');
 Route::post('contact/store', [HomeController::class, 'contactStore'])->name('contact.store');
 Route::post('bookCar/store/{id}', [HomeController::class, 'bookCarStore'])->name('bookCar.store');
Auth::routes();

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

Route::middleware(['web'])->group(function () {

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Profile
    Route::get('profile/edit', [ProfileController::class, 'profileEdit'])->name('admin.profile.edit');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');

    // Users
    Route::get('users/view', [UsersController::class, 'userView'])->name('admin.users.view');
    Route::get('users/create', [UsersController::class, 'userCreate'])->name('admin.users.create');
    Route::post('users/store', [UsersController::class, 'userStore'])->name('admin.users.store');
    Route::get('users/edit/{id}', [UsersController::class, 'userEdit'])->name('admin.users.edit');
    Route::post('users/update/{id}', [UsersController::class, 'userUpdate'])->name('admin.users.update');
    Route::delete('users/delete/{id}', [UsersController::class, 'userDelete'])->name('admin.users.delete');
    Route::get('users/search', [UsersController::class, 'userSearch'])->name('admin.users.search');

    // Contact Us
    Route::get('contact/view', [ContactController::class, 'contactView'])->name('admin.contact.view');
    Route::get('contact/reply/{id}', [ContactController::class, 'contactReply'])->name('admin.contact.reply');
    Route::post('contact/send/{id}', [ContactController::class, 'contactSend'])->name('admin.contact.send');
    Route::delete('contact/delete/{id}', [ContactController::class, 'contactDelete'])->name('admin.contact.delete');

    Route::get('sell/view', [ContactController::class, 'sellView'])->name('admin.sell.view');
    Route::delete('sell/delete/{id}', [ContactController::class, 'sellDelete'])->name('admin.sell.delete');

//book car
    Route::get('bookCar/view', [BookCarsController::class, 'bookCarView'])->name('admin.bookCar.view');
    Route::get('bookCar/reply/{id}', [BookCarsController::class, 'bookCarReply'])->name('admin.bookCar.reply');
    Route::post('bookCar/send/{id}', [BookCarsController::class, 'bookCarSend'])->name('admin.bookCar.send');
    Route::delete('bookCar/delete/{id}', [BookCarsController::class, 'bookCarDelete'])->name('admin.bookCar.delete');

    // Selling Car Details
    Route::get('car/view', [CarController::class, 'carView'])->name('admin.car.view');
    Route::get('car/create', [CarController::class, 'carCreate'])->name('admin.car.create');
    Route::post('car/store', [CarController::class, 'carStore'])->name('admin.car.store');
    Route::get('car/edit/{id}', [CarController::class, 'carEdit'])->name('admin.car.edit');
    Route::post('car/update/{id}', [CarController::class, 'carUpdate'])->name('admin.car.update');
    Route::delete('car/delete/{id}', [CarController::class, 'carDelete'])->name('admin.car.delete');
    Route::get('car/search', [CarController::class, 'carSearch'])->name('admin.car.search');

    // Homepage Banner
    Route::get('banner/view', [BannerController::class, 'bannerView'])->name('admin.banner.view');
    Route::get('banner/create', [BannerController::class, 'bannerCreate'])->name('admin.banner.create');
    Route::post('banner/store', [BannerController::class, 'bannerStore'])->name('admin.banner.store');
    Route::get('banner/edit/{id}', [BannerController::class, 'bannerEdit'])->name('admin.banner.edit');
    Route::post('banner/update/{id}', [BannerController::class, 'bannerUpdate'])->name('admin.banner.update');
    Route::delete('banner/delete/{id}', [BannerController::class, 'bannerDelete'])->name('admin.banner.delete');

    // Blogs
    Route::get('blog/view', [BlogController::class, 'blogView'])->name('admin.blog.view');
    Route::get('blog/create', [BlogController::class, 'blogCreate'])->name('admin.blog.create');
    Route::post('blog/store', [BlogController::class, 'blogStore'])->name('admin.blog.store');
    Route::get('blog/edit/{id}', [BlogController::class, 'blogEdit'])->name('admin.blog.edit');
    Route::post('blog/update/{id}', [BlogController::class, 'blogUpdate'])->name('admin.blog.update');
    Route::get('blog/show/{id}', [BlogController::class, 'blogShow'])->name('admin.blog.show');
    Route::delete('blog/delete/{id}', [BlogController::class, 'blogDelete'])->name('admin.blog.delete');
    Route::get('blog/search', [BlogController::class, 'blogSearch'])->name('admin.blog.search');
});
//for user
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user']], function () {
    Route::get('/home', [UserDashboardController::class, 'index'])->name('user.home');

    Route::get('/view/cars', [UserDashboardController::class, 'viewCars'])->name('users.view.cars');
    Route::get('cars/sorting',[UserDashboardController::class, 'sortCars'])->name('cars.sort');
    Route::get('/view/carsDetails/{id}', [UserDashboardController::class, 'viewCarsDetails'])->name('users.cars.details');
    
    Route::post('/review/submit/{id}', [ReviewController::class, 'submitReview'])->name('review.submit');
    Route::get('/review/reviews', [ReviewController::class, 'showReviews'])->name('review.reviews');
   
   

});
