<?php

use App\Livewire\Device;
use App\Livewire\DeviceAssign;
use App\Livewire\PlaceComplain;
use App\Livewire\ReleasedDevice;
use App\Livewire\UserManagement;
use App\Livewire\ComplainsAction;
use App\Livewire\DeviceAssignShow;
use App\Livewire\DeviceManagement;
use App\Livewire\CompletedComplains;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/dashboard/userManagement', UserManagement::class);
Route::get('/dashboard/device', Device::class);
Route::get('/dashboard/device/deviceManagement', DeviceManagement::class);
Route::get('/dashboard/device/deviceAssign',DeviceAssign::class);
Route::get('/dashboard/device/releasedDevice',ReleasedDevice::class);
Route::get('/placeComplain',PlaceComplain::class);
Route::get('/complainsAction',ComplainsAction::class);
Route::get('/completedComplains',CompletedComplains::class);
