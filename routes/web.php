<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TestController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $users = User::paginate(10);
        return view('dashboard', compact('users'));
    })->name('dashboard');

    Route::resource('attendance', AttendanceController::class);

    Route::get('test-seed-attendances', [TestController::class, 'testSeedAttendances']);
});

Route::get('attendance/test/', [AttendanceController::class, 'exportExcel'])->name('attendance.export');



require __DIR__ . '/auth.php';
