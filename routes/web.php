<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\InvitationsController;

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

Route::get("/users", [UserController::class, "index"]);
Route::get("/chatroom/{user:name}", function(User $user) {
   return view("index", compact("user")); 
});

Route::get("/create-group/{user:name}", [GroupController::class, "index"])
        ->name("create.group");
Route::post("/create-group", [GroupController::class, "store"])
        ->name("store.group");

Route::post("/invite/{group:unique_id}", [GroupController::class, "invite"]);
Route::get("/invitations/{user:name}", [InvitationsController::class, "index"])
        ->name("invitations");


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
