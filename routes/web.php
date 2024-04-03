<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\imageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AanvraagController;
use App\User;
use Illuminate\Support\Facades\Input;
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

Route::get('/dashboard', function () {
    $posts = App\Models\Post::where('user_id', auth()->user()->id)->get();
    $aanvragen = App\Models\Aanvraag::whereIn('post_id', $posts->pluck('id')->toArray())->get();
    $users = App\Models\User::whereIn('id', $aanvragen->pluck('user_id')->toArray())->get();
    return view('dashboard', ['posts' => $posts, 'aanvragen' => $aanvragen, 'users' => $users]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']
);

Route::post('/image', [imageController::class, 'upload'])->name('image');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/block', [UserController::class, 'block'])->name('users.block');
    Route::get('/users/{user}/admin', [UserController::class, 'admin'])->name('users.admin');
});

Route::middleware('auth')->group(function (){
    Route::get('/aanvraag/{post}', [AanvraagController::class, 'store'])->name('aanvraag.store');
    Route::get('/aanvraag/{thisAanvraag}/{post}/edit', [AanvraagController::class, 'edit'])->name('aanvraag.edit');
    Route::get('/aanvraag/{aanvraag}/destroy',[AanvraagController::class, 'destroy'])->name('aanvraag.destroy');
    Route::post('/aanvraag/{post}/review', [AanvraagController::class,'review'])->name('aanvraag.review');
});


require __DIR__.'/auth.php';
