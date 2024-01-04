<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ConferencePaperController;
use App\Http\Controllers\JournalPaperController;
use App\Http\Controllers\TeamMemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    // Authentication routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Other routes for managing web pages
    Route::get('/our-team', [AdminController::class, 'showTeamPage'])->name('admin.team');
    Route::get('/testimonials', [AdminController::class, 'showTestimonialPage'])->name('admin.testimonial');

    // About us routes
    Route::get('/about-us', [AdminController::class, 'showAboutUsPage'])->name('admin.about-us.index');
    Route::post('/about-us/store', [AdminController::class, 'store'])->name('admin.about-us.store');
    Route::put('/about-us/update/{id}', [AdminController::class, 'update'])->name('admin.about-us.update');
    Route::delete('/about-us/delete/{id}', [AdminController::class, 'delete'])->name('admin.about-us.delete');

    // Documentation routes
    Route::get('/publications', [AdminController::class, 'showDocumentationPage'])->name('admin.publications.index');
    Route::post('/publications/store', [AdminController::class, 'storeD'])->name('admin.publications.store');
    Route::put('/publications/update/{id}', [AdminController::class, 'updateD'])->name('admin.publications.update');
    Route::delete('/publications/delete/{id}', [AdminController::class, 'destroyD'])->name('admin.publications.delete');

    // Slideshow routes
    Route::get('/slideshow', [AdminController::class, 'showSlideshowPage'])->name('admin.slideshow.index');
    Route::post('/slideshow/store', [AdminController::class, 'createSlideshow'])->name('admin.slideshow.store');
    Route::put('/slideshow/update/{id}', [AdminController::class, 'updateSlideshow'])->name('admin.slideshow.update');
    Route::delete('/slideshow/delete/{id}', [AdminController::class, 'deleteSlideshow'])->name('admin.slideshow.delete');

    // Team routes
    Route::get('/teams', [AdminController::class, 'indexT'])->name('admin.teams.index');
    Route::get('/teams/create', [AdminController::class, 'createT'])->name('admin.teams.create');
    Route::post('/teams', [AdminController::class, 'storeT'])->name('admin.teams.store');
    Route::get('/teams/{id}/edit', [AdminController::class, 'editT'])->name('admin.teams.edit');
    Route::put('/teams/{id}', [AdminController::class, 'updateT'])->name('admin.teams.update');
    Route::delete('/teams/{id}', [AdminController::class, 'destroyT'])->name('admin.teams.destroy');

    // Contact routes
    Route::get('/contact', [AdminController::class, 'indexC'])->name('admin.contact.index');
    Route::get('/contact/create', [AdminController::class, 'createC'])->name('admin.contact.create');
    Route::post('/contact/store', [AdminController::class, 'storeC'])->name('admin.contact.store');
    Route::get('/contact/{id}/edit', [AdminController::class, 'editC'])->name('admin.contact.edit');
    Route::put('/contact/{id}/update', [AdminController::class, 'updateC'])->name('admin.contact.update');
    Route::delete('/contact/{id}/destroy', [AdminController::class, 'destroyC'])->name('admin.contact.destroy');

    // Blog routes
    Route::get('/blog', [AdminController::class, 'indexB'])->name('admin.blogs.index');
    Route::get('/blog/create', [AdminController::class, 'createB'])->name('admin.blogs.create');
    Route::post('/blog/store', [AdminController::class, 'storeB'])->name('admin.blogs.store');

    Route::get('/blog/{id}', [AdminController::class, 'showB'])->name('admin.blogs.show');

    Route::get('/blog/{id}/edit', [AdminController::class, 'editB'])->name('admin.blogs.edit');
    Route::put('/blog/{id}/update', [AdminController::class, 'updateB'])->name('admin.blogs.update');
    Route::delete('/blog/{id}/destroy', [AdminController::class, 'destroyB'])->name('admin.blogs.destroy');
    // routes/web.php

    Route::post('/upload/image', 'AdminController@uploadImage')->name('upload.image');


    // Conference paper routes
    Route::get('/conference_papers', [ConferencePaperController::class, 'indexCo'])->name('admin.conference_papers.index');
    Route::get('/conference_papers/create', [ConferencePaperController::class, 'createCo'])->name('admin.conference_papers.create');
    Route::post('/conference_papers/store', [ConferencePaperController::class, 'storeCo'])->name('admin.conference_papers.store');
    Route::get('/conference_papers/{conference_paper}/edit', [ConferencePaperController::class, 'editCo'])->name('admin.conference_papers.edit');
    Route::put('/conference_papers/{conference_paper}/update', [ConferencePaperController::class, 'updateCo'])->name('admin.conference_papers.update');
    Route::delete('/conference_papers/{conference_paper}/destroy', [ConferencePaperController::class, 'destroyCo'])->name('admin.conference_papers.destroy');

    // Journal paper routes
    Route::get('/journal_papers', [JournalPaperController::class, 'indexJo'])->name('admin.journal_papers.index');
    Route::get('/journal_papers/create', [JournalPaperController::class, 'createJo'])->name('admin.journal_papers.create');
    Route::post('/journal_papers/store', [JournalPaperController::class, 'storeJo'])->name('admin.journal_papers.store');
    Route::get('/journal_papers/{journal_paper}/edit', [JournalPaperController::class, 'editJo'])->name('admin.journal_papers.edit');
    Route::put('/journal_papers/{journal_paper}/update', [JournalPaperController::class, 'updateJo'])->name('admin.journal_papers.update');
    Route::delete('/journal_papers/{journal_paper}/destroy', [JournalPaperController::class, 'destroyJo'])->name('admin.journal_papers.destroy');
});
