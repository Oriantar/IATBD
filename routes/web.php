<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\imageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AanvraagController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PetProfileController;
use App\Models\Post;
use App\Models\Aanvraag;
use App\Models\User;
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
    $posts = Post::where('user_id', auth()->user()->id)->get();
    
    $aanvragen = Aanvraag::whereIn('post_id', $posts->pluck('id')->toArray())->get();
    $users = User::whereIn('id', $aanvragen->pluck('user_id')->toArray())->get();
    
    $jouwAanvragen = Aanvraag::where('user_id', Auth()->user()->id)->get(); 
    $aanvraagPosts = Post::whereIn('id', $jouwAanvragen->pluck('id')->toArray())->get();
    return view('dashboard', ['posts' => $posts, 'aanvragen' => $aanvragen, 'users' => $users, 'jouwAanvragen' => $jouwAanvragen, 'aanvraagPosts' => $aanvraagPosts]);
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

Route::middleware('auth')->group(function (){
    Route::get('/user/{user}', [UserProfileController::class, 'index'])->name('user.index');
    Route::post('/user/{user}/upload', [UserProfileController::class, 'upload'])->name('user.upload');
});

Route::middleware('auth')->group(function (){
    Route::get('/pet/{post}', [PetProfileController::class, 'index'])->name('pet.index');
    Route::post('/pet/{post}/upload', [PetProfileController::class, 'upload'])->name('pet.upload');
});


require __DIR__.'/auth.php';
