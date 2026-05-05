<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;


Route::prefix('admin')
    ->middleware(['auth', 'admin.access'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('admin.profile.edit');

        Route::post('/profile', [ProfileController::class, 'update'])
            ->name('admin.profile.update');
    });

	
 	
Route::get('/', function () {
    return view('welcome');
});	
	

require __DIR__.'/auth.php';
