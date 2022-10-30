<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BookingHistoryController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Admin\FleetController;
use App\Http\Controllers\Admin\VehiclesController;
use App\Http\Controllers\Admin\RoutesController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TripController;
use  App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AmenitiesController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\LanguageController;
// use App\Http\Controllers\Admin\VehicleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('list', [UserController::class, 'userList'])->name('users-list');
        Route::get('create', [UserController::class, 'create'])->name('users-create');
        Route::post('save', [UserController::class, 'saveUser'])->name('users-save');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('update', [UserController::class, 'update'])->name('users.update');
        Route::get('deleet', [UserController::class, 'delete'])->name('users.delete');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
    });
    Route::prefix('language')->group(function(){
        Route::get('/',[LanguageController::class,'index'])->name('language');
        Route::get('list',[LanguageController::class,'language_list'])->name('language_list');
        Route::get('add',[LanguageController::class,'add'])->name('language-add');
        Route::get('create',[LanguageController::class,'create'])->name('language-create');
        Route::get('edit',[LanguageController::class,'edit'])->name('language-edit');
        Route::get('update',[LanguageController::class,'update'])->name('language-update');
        Route::get('delete',[LanguageController::class,'delete'])->name('language-delete');
        Route::get('translate/{locate}',[LanguageController::class,'translate'])->name('language-translate');
        // Route::get('switch',[LanguageController::class,'switch'])->name('language-switch');
        Route::get('translate_create',[LanguageController::class,'translate_create'])->name('translate_create');
        Route::post('trns-updatee',[LanguageController::class,'translate_update'])->name('translate_update');
        Route::get('switch/{locate}',[LanguageController::class,'switch'])->name('switch');
    
    });
    Route::prefix('country')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('country-list');
        Route::get('list', [CountryController::class, 'country_list'])->name('counrty-list');
        Route::get('create', [CountryController::class, 'create'])->name('counry-create');
        Route::post('save', [CountryController::class, 'savecountry'])->name('country-save');
        Route::get('edit/{id}', [CountryController::class, 'edit'])->name('country-edit');
        Route::post('update', [CountryController::class, 'update'])->name('country-update');
        Route::get('delete', [CountryController::class, 'delete'])->name('country-delete');
    });
    Route::prefix('bookinghistory')->group(function () {

        Route::get('list', [BookingHistoryController::class, 'bookinghistorylist'])->name('bookinghistory-list');
        Route::get('create', [BookingHistoryController::class, 'create'])->name('bookinghistory-create');
        Route::post('save', [BookingHistoryController::class, 'saveData'])->name('bookinghistory-save');
        Route::get('edit/{id}', [BookingHistoryController::class, 'edit'])->name('bookinghistory-edit');
        Route::post('update', [BookingHistoryController::class, 'update'])->name('bookinghistory-update');
        Route::get('delete', [BookingHistoryController::class, 'delete'])->name('bookinghistory-delete');
        Route::get('/{status?}', [BookingHistoryController::class, 'index'])->name('bookinghistory');
    });
    Route::prefix('supportTicket')->group(function () {
        Route::get('create', [SupportTicketController::class, 'create'])->name('supportTicket.create');
        Route::get('/{status?}', [SupportTicketController::class, 'index'])->name('supportTicket');
    });
    Route::prefix('counter')->group(function () {
        Route::get('/', [CounterController::class, 'index'])->name('counter.index');
        Route::get('list', [CounterController::class, 'user_list'])->name('counter.list');
        Route::get('add', [CounterController::class, 'add'])->name('counter.add');
        Route::post('create', [CounterController::class, 'create'])->name('counter.create');
        Route::get('edit/{id}', [CounterController::class, 'edit'])->name('counter.edit');
        Route::post('update', [CounterController::class, 'update'])->name('counter.update');
        Route::get('delete', [CounterController::class, 'delete'])->name('counter.delete');
    });
    Route::prefix('manage')->group(function () {
        Route::prefix('layout')->group(function () {
            Route::get('/', [FleetController::class, 'index'])->name('layout');
            Route::get('layoutlist', [FleetController::class, 'layoutlist'])->name('layout-list');
            Route::post('layout-create', [FleetController::class, 'create'])->name('layout-create');
            Route::post('update', [FleetController::class, 'update'])->name('layout-update');
            Route::get('delete', [FleetController::class, 'delete'])->name('layout-delete');
        });
        Route::prefix('fleetType')->group(function () {
            Route::get('/', [FleetController::class, 'fleetType'])->name('fleetType');
            Route::get('fleetTypelist', [FleetController::class, 'fleetTypelist'])->name('fleetTypelist');
            Route::post('fleetType-create', [FleetController::class, 'fleetTypeSave'])->name('fleetType-create');
            Route::get('edit', [FleetController::class, 'editfleetType'])->name('fleetType-edit');
            Route::get('delete', [FleetController::class, 'deletefleetType'])->name('deletefleetType');
        });
        Route::prefix('vehicles')->group(function () {
            Route::get('/', [VehiclesController::class, 'index'])->name('vehicles');
            Route::get('list', [VehiclesController::class, 'vehicles'])->name('vehicles-list');
            Route::get('vehicles-create', [VehiclesController::class, 'vehiclesCreate'])->name('vehicles-create');
            Route::post('vehicles-save', [VehiclesController::class, 'vehiclesSave'])->name('vehicles-save');
            Route::get('edit/{id}', [VehiclesController::class, 'edit'])->name('vehicles-edit');
            Route::post('update', [VehiclesController::class, 'update'])->name('vehicles-update');
            Route::get('delete', [VehiclesController::class, 'delete'])->name('vehicles-delete');
            Route::get('status', [VehiclesController::class, 'status'])->name('vehicles-status');
        });
    });

    Route::prefix('manageTrip')->group(function () {
        Route::prefix('route')->group(function () {
            Route::get('/', [RoutesController::class, 'index'])->name('route');
            Route::get('list', [RoutesController::class, 'routesList'])->name('routes-list');
            Route::get('create', [RoutesController::class, 'create'])->name('route-create');
            Route::post('route-save', [RoutesController::class, 'routeSave'])->name('route-save');
            Route::get('edit/{id}', [RoutesController::class, 'edit'])->name('route-edit');
            Route::post('update', [RoutesController::class, 'update'])->name('route-update');
            Route::get('status', [RoutesController::class, 'status'])->name('route-status');
            Route::get('delete', [RoutesController::class, 'delete'])->name('route-delete');
        });
        Route::prefix('schedule')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('schedule');
            Route::get('list', [ScheduleController::class, 'scheduleList'])->name('schedule-list');
            Route::get('create', [ScheduleController::class, 'create'])->name('schedule-create');
            Route::post('schedule-save', [ScheduleController::class, 'scheduleSave'])->name('schedule-save');
            Route::get('edit/{id}', [ScheduleController::class, 'edit'])->name('schedule-edit');
            Route::post('update', [ScheduleController::class, 'update'])->name('schedule-update');
            Route::get('delete', [ScheduleController::class, 'delete'])->name('schedule-delete');
            Route::get('status', [ScheduleController::class, 'status'])->name('schedule-status');
        });
        Route::prefix('ticket')->group(function () {
            Route::get('/', [TicketController::class, 'index'])->name('ticket');
            Route::get('list', [TicketController::class, 'ticketList'])->name('ticket-list');
            Route::get('create', [TicketController::class, 'create'])->name('ticket-create');
            Route::post('ticket-save', [TicketController::class, 'ticketSave'])->name('ticket-save');
            Route::get('edit/{id}', [TicketController::class, 'edit'])->name('ticket-edit');
            Route::post('update', [TicketController::class, 'update'])->name('ticket-update');
            Route::get('delete', [TicketController::class, 'delete'])->name('ticket-delete');
        });
        Route::prefix('trip')->group(function () {
            Route::get('/', [TripController::class, 'index'])->name('trip');
            Route::get('list', [TripController::class, 'tripList'])->name('trip-list');
            Route::get('create', [TripController::class, 'create'])->name('trip-create');
            Route::post('trip-save', [TripController::class, 'TripSave'])->name('trip-save');
            Route::get('edit/{id}', [TripController::class, 'edit'])->name('trip-edit');
            Route::post('update', [TripController::class, 'update'])->name('trip-update');
            Route::get('delete', [TripController::class, 'delete'])->name('trip-delete');
        });
        Route::prefix('vehicle')->group(function () {
            Route::get('/', [VehicleController::class, 'index'])->name('vehicle');
            Route::get('list', [VehicleController::class, 'vehicleList'])->name('vehicle-list');
            Route::get('create', [VehicleController::class, 'create'])->name('vehicle-create');
            Route::post('vehicle-save', [VehicleController::class, 'vehicleSave'])->name('vehicle-save');
            Route::get('edit/{id}', [VehicleController::class, 'edit'])->name('vehicle-edit');
            Route::post('update', [VehicleController::class, 'update'])->name('vehicle-update');
            Route::get('delete', [VehicleController::class, 'delete'])->name('vehicle-delete');
        });
    });
    Route::prefix('section')->group(function () {
        Route::get('about', [AboutController::class, 'about'])->name('about');
        Route::post('create', [AboutController::class, 'create'])->name('about-create');
        Route::prefix('amenities')->group(function () {
            Route::get('/', [AmenitiesController::class, 'index'])->name('amenities');
            Route::get('add',[AmenitiesController::class, 'add'])->name('amenities.add');
            Route::post('create',[AmenitiesController::class, 'create'])->name('amenities.create');
            Route::get('edit/{id}',[AmenitiesController::class, 'edit'])->name('amenities.edit');
            Route::post('update',[AmenitiesController::class, 'update'])->name('amenities.update');
            Route::get('delete',[AmenitiesController::class, 'delete'])->name('amenities.delete');
        });

        Route::prefix('contact')->group(function(){
            Route::get('/',[ContactController::class ,'index'])->name('contact');
            Route::get('list',[ContactController::class ,'contact_list'])->name('contact.list');
            Route::get('add',[ContactController::class,'add'])->name('contact.add');
            Route::post('create',[ContactController::class,'create'])->name('contact.create');
            Route::get('edit/{id}',[ContactController::class,'edit'])->name('contact.edit');
            Route::post('update',[ContactController::class,'update'])->name('contact.update');
            Route::get('delete',[ContactController::class ,'delete'])->name('contact.delete');
        });
        Route::prefix('profile')->group(function(){
            Route::get('/',[ProfileController::class,'index'])->name('profile');
            Route::post('updatepassword',[ProfileController::class, 'updatepassword'])->name('updatepassword');
           
        });
    });
});
