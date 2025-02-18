<?php


use App\Http\Controllers\GoogleCalendarAuthController;
use App\Http\Controllers\GoogleCalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\FacilitiesController;
use App\Http\Controllers\User\UserMeetingController;
use App\Http\Controllers\Notulensi\ConclutionMeetingsController;
use App\Http\Controllers\Sekertaris\MeetingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DataMeetingController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SummaryPhotoController;
use Barryvdh\DomPDF\Facade as PDF;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('eroor', function () {
        return view('errors.403');
    });


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Route::get('message', [DashboardController::class, 'getLatestMeetings'])->name('message.getLatestMeetings');
    // Route::get('message', [DashboardController::class, 'getNotifications'])->name('getNotifications');


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for different roles

});



Route::fallback(function () {
    return view('errors.404');
});


Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Route::get('/', function () {
//     return view('tes');
// });
// Route::get('/ruang-rapat', function () {
//     return view('admin.ruang-rapat');
// });
// Route::get('/', [AuthenticatedSessionController::class, 'create'])
// ->name('login');

// Route::get('/login', function () {
//     return view('auth.login');
// });
//route admin


Route::middleware(['auth', 'role:1'])->group(function () {

    // Rooms Routes
    Route::get('rooms', [RoomsController::class, 'index'])->name('rooms.index');
    Route::get('rooms/create', [RoomsController::class, 'create'])->name('rooms.create');
    Route::post('rooms', [RoomsController::class, 'store'])->name('rooms.store');
    Route::get('rooms/{room}', [RoomsController::class, 'edit'])->name('rooms.edit');
    Route::put('rooms/{room}', [RoomsController::class, 'update'])->name('rooms.update');
    Route::delete('rooms/{room}', [RoomsController::class, 'destroy'])->name('rooms.destroy');

    // Facilities Routes
    Route::get('fas', [FacilitiesController::class, 'index'])->name('fas.index');
    Route::get('fas/create', [FacilitiesController::class, 'create'])->name('fas.create');
    Route::post('fas', [FacilitiesController::class, 'store'])->name('fas.store');
    Route::delete('fas/{facility}', [FacilitiesController::class, 'destroy'])->name('fas.destroy');
    Route::get('fas/{facility}', [FacilitiesController::class, 'edit'])->name('fas.edit');
    Route::put('fas/{facility}', [FacilitiesController::class, 'update'])->name('fas.update');

    // Users Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');

    // Meeting Result Routes
    Route::get('meeting-result', [DataMeetingController::class, 'meetingresult'])->name('meeting.meetingresult');
    Route::get('detail-result/{id}', [DataMeetingController::class, 'detailresult'])->name('meeting.detailresult');
});


Route::middleware(['auth', 'role:2'])->group(function () {
    // route sekertaris

    Route::get('meeting', [MeetingController::class, 'index'])->name('meeting.index');
    Route::get('meeting-schedule', [MeetingController::class, 'schedule'])->name('meeting.schedule');
    Route::get('meeting-result', [MeetingController::class, 'meetingresult'])->name('meeting.meetingresult');
    Route::get('detail-result/{id}', [MeetingController::class, 'detailresult'])->name('meeting.detailresult');
    Route::get('meeting-create', [MeetingController::class, 'create'])->name('meeting.create');
    Route::get('meeting/{id}', [MeetingController::class, 'edit'])->name('meeting.edit');
    Route::put('meeting/{id}', [MeetingController::class, 'update'])->name('meeting.update');
    Route::post('meeting', [MeetingController::class, 'store'])->name('meeting.store');
    Route::delete('meeting/{id}', [MeetingController::class, 'destroy'])->name('meeting.destroy');
    Route::get('meeting/show/{id}', [MeetingController::class, 'show'])->name('meeting.show');
    Route::get('/meeting/preview/{id}', [MeetingController::class, 'preview'])->name('meeting.preview');
    Route::post('/meeting/send-invitation/{id}', [MeetingController::class, 'sendInvitation'])->name('meeting.sendInvitation');
});


// route notulen
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('conclution-meetings', [ConclutionMeetingsController::class, 'index'])->name('conclution-meetings.index');
    Route::get('conclution-meetings/{summary}', [ConclutionMeetingsController::class, 'edit'])->name('conclution-meetings.edit');
    Route::get('conclution-meetingss/{summary}', [ConclutionMeetingsController::class, 'show'])->name('conclution-meetingss.show');
    Route::put('conclution-meetings/{summary}', [ConclutionMeetingsController::class, 'update'])->name('conclution-meetings.update');
});


Route::middleware(['auth', 'role:4'])->group(function () {

    Route::get('users-meetings', [UserMeetingController::class, 'index'])->name('users-meetings.index');
    Route::get('users-meetings-schedule/{id}', [UserMeetingController::class, 'detailscheduleuser'])->name('users-meetings.detailscheduleuser');
    Route::get('users-result-meetings', [UserMeetingController::class, 'resultusermeeting'])->name('users-result-meetings.resultusermeeting');
    Route::get('users-meetings-result/{id}', [UserMeetingController::class, 'detailuserresult'])->name('users-meetings.detailuserresult');
});


Route::get('/auth/google', [GoogleCalendarAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleCalendarAuthController::class, 'handleGoogleCallback']);
Route::get('/google-calendar', [GoogleCalendarController::class, 'createEvent']);
Route::get('/meeting/{id}/download-pdf', [MeetingController::class, 'downloadPDF'])->name('meeting.downloadPDF');
require __DIR__ . '/auth.php';
