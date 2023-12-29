<?php

use App\Http\Controllers\Api\AracOzellikController;
use App\Http\Controllers\Api\RezervasyonController as Rezervasyon;
use App\Http\Controllers\AracController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KonumController;
use App\Http\Controllers\KuponController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RezervasyonController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YorumController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
 });

Route::middleware('setLanguage')->get('/', [IndexController::class,'index'])->name('index');
Route::middleware('setLanguage')->get('/arac-secimi/', [IndexController::class,'aracSecimi'])->name('aracSecimi');
Route::middleware('setLanguage')->post('/rezervasyon/create', [RezervasyonController::class,'store'])->name('rezervasyon.store');

Route::group(['prefix' => 'yorum', 'middleware' => ['auth']], function(){
    Route::get('/',[YorumController::class,'index'])->name('yorum');
    Route::post('/create',[YorumController::class,'store'])->name('yorum.store');
    Route::delete('/destroy/{id}',[YorumController::class,'destroy'])->name('yorum.destroy');
});

 Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('/');

Route::get('change-language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return back();
});

Route::middleware(['checkAdmin'])->group(function () {

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::prefix('slider')->group(function () {
    Route::get('/',[SlideController::class,'index'])->name('slider');
    Route::post('/create',[SlideController::class,'store'])->name('slider.store');
    Route::patch('/update',[SlideController::class,'update'])->name('slider.update');
    Route::delete('/destroy/{id}',[SlideController::class,'destroy'])->name('slider.destroy');
    });
Route::prefix('aracTuru')->group(function () {
        Route::get('/',[AracController::class,'index'])->name('aracTuru');
        Route::post('/create',[AracController::class,'store'])->name('aracTuru.store');
        Route::delete('/destroy',[AracController::class,'destroy'])->name('aracTuru.destroy');

    // Özellik
        Route::post('/ozellik/create',[AracController::class,'ozellikStore'])->name('aracTuru.ozellik.store');
        Route::delete('/ozellik/destroy',[AracController::class,'ozellikDestroy'])->name('aracTuru.ozellik.destroy');
        });

Route::prefix('portfoy')->group(function () {
    Route::get('/',[PortfolioController::class,'index'])->name('portfoy');
    Route::post('/create',[PortfolioController::class,'store'])->name('portfoy.store');
    Route::delete('/destroy/{id}',[PortfolioController::class,'destroy'])->name('portfoy.destroy');
// Kategori
    Route::post('/kategori/create',[PortfolioController::class,'categoryStore'])->name('portfoy.kategori.store');
    Route::delete('/kategori/destroy/{id}',[PortfolioController::class,'categoryDestroy'])->name('portfoy.kategori.destroy');
    });

Route::prefix('konum')->group(function () {
        Route::get('/',[KonumController::class,'index'])->name('konum');
        Route::post('/create',[KonumController::class,'store'])->name('konum.store');
        Route::delete('/destroy/{id}',[KonumController::class,'destroy'])->name('konum.destroy');
        });

Route::prefix('user')->group(function () {
        Route::get('/',[UserController::class,'index'])->name('users');
        Route::delete('/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
        });

Route::prefix('transfer')->group(function () {
    Route::get('/',[TransferController::class,'index'])->name('transfer');
    Route::post('/create',[TransferController::class,'store'])->name('transfer.store');
    Route::patch('/transfer/update', [TransferController::class, 'update'])->name('transfer.update');
    Route::delete('/destroy/{id}',[TransferController::class,'destroy'])->name('transfer.destroy');
    });

Route::prefix('rezervasyon')->group(function () {
    Route::get('/',[RezervasyonController::class,'index'])->name('rezervasyon');
    Route::delete('/destroy/{id}',[RezervasyonController::class,'destroy'])->name('rezervasyon.destroy');
        });
Route::prefix('kupon')->group(function () {
    Route::post('/create',[KuponController::class,'store'])->name('kupon.store');
    Route::delete('/destroy/{id}',[KuponController::class,'destroy'])->name('kupon.destroy');
                });
Route::post('api/getAracOzellikData',[AracOzellikController::class,'getAracOzellikData']);
Route::post('api/rezervasyon',[Rezervasyon::class,'index']);
});

require __DIR__.'/auth.php';
