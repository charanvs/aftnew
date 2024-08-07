<?php

use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\JudgementController;
use App\Http\Controllers\AdvancedSearchController;
use App\Http\Controllers\File\FileController;
use App\Http\Controllers\cases\CaseManagementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Backend\CaseController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\Backend\VacancyController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\BenchController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Utility\SqlUtilityController;


Route::get('/', function () {
    return view('frontend.index');
});


Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('admin.index', compact('user'));
})->middleware(['web', 'auth', 'verified'])->name('dashboard');


// Admin All Route
Route::middleware(['auth'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        // Route::get('/admin/dashboard', 'index')->name('dashboard');
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');

        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
    });
});


// Judgement Routes
Route::controller(JudgementController::class)->group(function () {

    Route::get('/judgements/search', 'ShowJudgements')->name('judgements.page');
    Route::get('/judgements/search/all', 'JudgementsSearch')->name('judgements.search.all');
    Route::get('/judgements/search/any', 'WildSearch')->name('judgements.search.wild');
    Route::get('/judgements/search/show', 'ShowJudgementsData')->name('judgements.show');
    Route::get('/judgements/pdf', 'ShowPdf')->name('judgements.pdf');
    Route::get('/judgements/reportable', 'ReportableJudgements')->name('judgements.reportable');
    Route::get('/judgements/large/bench', 'LargeBenchJudgements')->name('judgements.largebench');
});
// Diary Routes
Route::controller(DiaryController::class)->group(function () {

    Route::get('/diary/search', 'ShowDiary')->name('diary.page');
    Route::get('/diary/search/all', 'DiarySearch')->name('diary.search');
    Route::get('/diary/search/show', 'ShowDiaryData')->name('diary.show');
});

// Case Management Routes
Route::controller(CaseManagementController::class)->group(function () {
    Route::get('/show/cases', 'ShowCases')->name('cases.page');
    Route::get('/cases/search/all', 'CaseSearch')->name('cases.search.all');
    Route::get('/cases/search/show', 'ShowCasesData')->name('case.show');
    Route::get('/pdf/{id}', 'GeneratePDF')->name('generate.pdf');
    Route::get('/advanced/search', 'AdvancedSearch')->name('advanced.search');
    Route::get('/advanced/search/perform', 'searchPerform')->name('advanced.search.perform');
});

//  Advanced Search Routes
Route::controller(AdvancedSearchController::class)->group(function () {
    Route::get('/advanced/search', 'AdvancedSearch')->name('advanced.search');
    Route::get('/advanced/search/perform', 'searchPerform')->name('advanced.search.perform');
});

// Frontend Routes
Route::controller(FrontendController::class)->group(function () {
    Route::get('/home', 'Home')->name('home');
    Route::get('/members', 'Members')->name('members.page');
    Route::get('/daily_cause_list', 'DailyCauseList')->name('daily_cause_list.page');
    Route::get('/vacancies', 'Vacancies')->name('vacancies.page');
    Route::get('/acts_rules', 'Rules')->name('rules.page');
    Route::get('/home/test', 'HomeTest')->name('home.test');
    Route::get('/organization/chart', 'OrganizationChart')->name('organization.chart');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(TeamController::class)->group(function () {
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
    });
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/banner/store', 'StoreBanner')->name('banner.store');
    });

    Route::controller(CalendarController::class)->group(function () {
        Route::get('/calendar', 'index')->name('calendar');
        Route::post('/calendar/events', 'store')->name('calendar.store');
        Route::delete('/events/{id}', 'destroy')->name('calendar.delete');
    });

    Route::controller(VacancyController::class)->group(function () {
        Route::get('/backend/vacancy', 'index')->name('all.vacancy');
        Route::get('/add/vacancy', 'AddVacancy')->name('add.vacancy');
        Route::post('/vacancy/store', 'StoreVacancy')->name('vacancy.store');
        Route::get('/vacancy/edit/{id}', 'EditVacancy')->name('vacancy.edit');
        Route::post('/vacancy/update', 'UpdateVacancy')->name('vacancy.update');
        Route::get('/vacancy/delete/{id}', 'DeleteVacancy')->name('vacancy.delete');
    });

    Route::controller(GalleryController::class)->group(function () {
        Route::get('/backend/gallery', 'index')->name('all.gallery');
        Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
        Route::post('/gallery/store', 'StoreGallery')->name('gallery.store');
        // Route::get('/vacancy/edit/{id}', 'EditVacancy')->name('vacancy.edit');
        // Route::post('/vacancy/update', 'UpdateVacancy')->name('vacancy.update');
        // Route::get('/vacancy/delete/{id}', 'DeleteVacancy')->name('vacancy.delete');
    });

    Route::controller(BenchController::class)->group(function () {
        Route::get('/all/bench', 'AllBench')->name('all.bench');
        Route::get('/add/bench', 'AddBench')->name('add.bench');
        Route::post('/bench/store', 'StoreBench')->name('bench.store');
    });

    Route::get('/api/events', [EventController::class, 'getEvents']);
    Route::post('/api/events', [EventController::class, 'addEvent']);
    Route::put('/api/events/{id}', [EventController::class, 'updateEvent']);
    Route::delete('/api/events/{id}', [EventController::class, 'deleteEvent']);

    Route::resource('cases', CaseController::class);
    Route::get('daily/list/pdf', [CaseController::class, 'generatePDF'])->name('daily.list.pdf');
    Route::get('/case-search', [CaseController::class, 'caseSearch'])->name('case.search');
});


require __DIR__ . '/auth.php';

Route::get('/standardize-filenames', [FileController::class, 'standardizeFilenames']);

Route::get('/fullcalender', [EventController::class, 'index']);
Route::post('/fullcalenderAjax', [EventController::class, 'ajax']);

// utility routes
Route::get('/sql_utility', [SqlUtilityController::class, 'index']);
Route::post('/sql-utility/validate', [SqlUtilityController::class, 'validateSql']);
Route::get('/sql-utility/tables', [SqlUtilityController::class, 'getTables']);

Route::get('/events', [EventController::class, 'getEvents'])->name('events.get');
