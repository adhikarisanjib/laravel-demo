<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FallbackController;

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

Route::get("/", HomeController::class);

// Route::resource("blog", PostController::class);
// Route::match(["GET", "POST"], "/blog", [PostController::class, "index"]);

// Route::get("/blog", [PostController::class, "index"])->name("blog.home");
// Route::get("/blog/{id}", [PostController::class, "show"])->name("blog.show");

// // Route::get("/blog/{id}", [PostController::class, "show"])->whereNumber("id");
// // Route::get("/blog/{id}", [PostController::class, "show"])->where("id", "[0-9]+");
// // Route::get("/blog/{id}", [PostController::class, "show"])->whereAlpha("name");
// // Route::get("/blog/{name}", [PostController::class, "show"])->where("name", "[A-Za-z]+");

// Route::get("/blog/create", [PostController::class, "create"])->name("blog.create");
// Route::post("/blog", [PostController::class, "store"])->name("blog.store");

// Route::get("/blog/edit/{id}", [PostController::class, "edit"])->name("blog.edit");
// Route::patch("/blog/{id}", [PostController::class, "update"])->name("blog.update");

// Route::delete("/blog/{id}", [PostController::class, "destroy"])->name("blog.destroy");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix("/blog")->group(function () {
    Route::get("/create", [PostController::class, "create"])->name("blog.create");
    Route::get("/", [PostController::class, "index"])->name("blog.home");
    Route::get("/{id}", [PostController::class, "show"])->name("blog.show");
    Route::post("/", [PostController::class, "store"])->name("blog.store");
    Route::get("/edit/{id}", [PostController::class, "edit"])->name("blog.edit");
    Route::patch("/{id}", [PostController::class, "update"])->name("blog.update");
    Route::delete("/{id}", [PostController::class, "destroy"])->name("blog.destroy");
});

Route::fallback(FallbackController::class);

