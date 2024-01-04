<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\AboutUsController;
use App\Http\Controllers\API\SlideshowController;
use App\Http\Controllers\API\TestimonialController;
use App\Http\Controllers\API\DocumentationController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\BlogController;

use App\Http\Controllers\API\ConferencePaperController;

use App\Http\Controllers\API\JournalPaperController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/admin/login', [AdminController::class, 'login']);
// Define other API routes for admin functionality here



Route::prefix('teams')->group(function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::post('/', [TeamController::class, 'store']);
    Route::get('/{id}', [TeamController::class, 'show']);
    Route::put('/{id}', [TeamController::class, 'update']);
    Route::delete('/{id}', [TeamController::class, 'destroy']);
});



Route::prefix('about-us')->group(function () {
    Route::get('/', [AboutUsController::class, 'index']);
    Route::post('/', [AboutUsController::class, 'store']);
    Route::get('/{id}', [AboutUsController::class, 'show']);
    Route::put('/{id}', [AboutUsController::class, 'update']);
    Route::delete('/{id}', [AboutUsController::class, 'destroy']);
    // Other routes for specific operations like update, delete, etc.
});

Route::prefix('slideshows')->group(function () {
    Route::get('/', [SlideshowController::class, 'index']);
    Route::post('/', [SlideshowController::class, 'store']);
    Route::get('/{id}', [SlideshowController::class, 'show']);
    Route::put('/{id}', [SlideshowController::class, 'update']);
    Route::delete('/{id}', [SlideshowController::class, 'destroy']);
    // Other routes for specific operations like update, delete, etc.
});

Route::prefix('testimonials')->group(function () {
    Route::get('/', [TestimonialController::class, 'index']);
    Route::post('/', [TestimonialController::class, 'store']);
    Route::get('/{id}', [TestimonialController::class, 'show']);
    Route::put('/{id}', [TestimonialController::class, 'update']);
    Route::delete('/{id}', [TestimonialController::class, 'destroy']);
    // Other routes for specific operations like update, delete, etc.
});



Route::prefix('documentations')->group(function () {
    Route::get('/', [DocumentationController::class, 'index']);
    Route::post('/', [DocumentationController::class, 'store']);
    Route::get('/{id}', [DocumentationController::class, 'show']);
    Route::put('/{id}', [DocumentationController::class, 'update']);
    Route::delete('/{id}', [DocumentationController::class, 'destroy']);
    // Other specific routes as needed
});

Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::post('/', [ContactController::class, 'store']);
    Route::get('/{id}', [ContactController::class, 'show']);
    Route::put('/{id}', [ContactController::class, 'update']);
    Route::delete('/{id}', [ContactController::class, 'destroy']);
    // Other specific routes for contacts as needed
});

Route::get('blogs/latest', [BlogController::class, 'latestBlogs']);
Route::resource('blogs', BlogController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);


// Conference Paper Routes
Route::get('/conference_papers', [ConferencePaperController::class, 'index']);
Route::get('/conference_papers/{conferencePaper}', [ConferencePaperController::class, 'show']);
Route::post('/conference_papers', [ConferencePaperController::class, 'store']);
Route::put('/conference_papers/{conferencePaper}', [ConferencePaperController::class, 'update']);
Route::delete('/conference_papers/{conferencePaper}', [ConferencePaperController::class, 'destroy']);

// // Endpoint to get a list of all conference papers
// Route::get('http://127.0.0.1:8000/api/conference_papers', [ConferencePaperController::class, 'index']);

// // Endpoint to get details of a specific conference paper by ID
// Route::get('http://127.0.0.1:8000/api/conference_papers/{id}', [ConferencePaperController::class, 'show']);

// // Endpoint to create a new conference paper
// Route::post('http://127.0.0.1:8000/api/conference_papers', [ConferencePaperController::class, 'store']);

// // Endpoint to update a specific conference paper by ID
// Route::put('http://127.0.0.1:8000/api/conference_papers/{id}', [ConferencePaperController::class, 'update']);

// // Endpoint to delete a specific conference paper by ID
// Route::delete('http://127.0.0.1:8000/api/conference_papers/{id}', [ConferencePaperController::class, 'destroy']);



// Journal Paper Routes

// Endpoint to get a list of all journal papers
Route::get('/journal_papers', [JournalPaperController::class, 'index']);

// Endpoint to get details of a specific journal paper by ID
Route::get('/journal_papers/{id}', [JournalPaperController::class, 'show']);

// Endpoint to create a new journal paper
Route::post('/journal_papers', [JournalPaperController::class, 'store']);

// Endpoint to update a specific journal paper by ID
Route::put('/journal_papers/{id}', [JournalPaperController::class, 'update']);

// Endpoint to delete a specific journal paper by ID
Route::delete('/journal_papers/{id}', [JournalPaperController::class, 'destroy']);

// // Endpoint to get a list of all journal papers
// Route::get('http://127.0.0.1:8000/api/journal_papers', [JournalPaperController::class, 'index']);

// // Endpoint to get details of a specific journal paper by ID
// Route::get('http://127.0.0.1:8000/api/journal_papers/{id}', [JournalPaperController::class, 'show']);

// // Endpoint to create a new journal paper
// Route::post('http://127.0.0.1:8000/api/journal_papers', [JournalPaperController::class, 'store']);

// // Endpoint to update a specific journal paper by ID
// Route::put('http://127.0.0.1:8000/api/journal_papers/{id}', [JournalPaperController::class, 'update']);

// // Endpoint to delete a specific journal paper by ID
// Route::delete('http://127.0.0.1:8000/api/journal_papers/{id}', [JournalPaperController::class, 'destroy']);