<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------------*-
-----------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/', [MainController::class, 'main'])->name('login');
Route::get('logout', [MainController::class, 'logout'])->name('logout');
Route::get('/register', [MainController::class, 'register'])->name('register');
Route::post('/save_user', [MainController::class, 'save_user'])->name('save_user');
Route::post('/authenticate', [MainController::class, 'auth_user'])->name('auth_user');

// Route::group(['prefix' => 'admin', 'middleware' => ['checkUser']], function () {
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
    Route::get('home', [MainController::class, 'dashboard'])->name('dash');
    Route::get('widgets', [MainController::class, 'widgets'])->name('widgets');
});

// Route::group(['prefix' => 'students', 'middleware' => ['checkUser']], function () {
Route::group(['prefix' => 'students', 'middleware' => ['role:student']], function () {

    Route::get('main', [StudentController::class, 'main'])->name('students.main');
    Route::get('profile', [StudentController::class, 'profile'])->name('students.profile');
    Route::post('add', [StudentController::class, 'add'])->name('students.add');
    Route::post('deact_user/{usr_id}', [StudentController::class, 'deact_user'])->name('students.deactivate');
});

Route::group(['prefix' => 'course', 'middleware' => ['checkUser']], function () {
    Route::get('main', [CourseController::class, 'main'])->name('course.main');
    Route::post('save-course', [CourseController::class, 'save_course'])->name('course.add');
});

// Route::group(['middleware' => ['role:admin|student']], function () {
//     Route::get('/shared-page', [MainController::class, 'shared']);
// });



Route::get('/locations/{region}/provinces', [MainController::class, 'provinces']);
Route::get('/locations/{province}/municipalities', [MainController::class, 'municipalities']);
Route::get('/locations/{muni}/barangays', [MainController::class, 'barangays']);

