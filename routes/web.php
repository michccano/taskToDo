<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\TaskController;
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

Route::get('/login', [AuthController::class, "login"])->name('login');

Route::get('/register', [AuthController::class, "register"]);

Route::post('/registerpost', [AuthController::class, 'register_post'])
    ->name('registerpost');

Route::post('/loginpost', [AuthController::class, 'login_post'])
    ->name('loginpost');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/alltasks', [TaskController::class, "allTasks"])->name('dashboard');

    Route::get('/deletedtaskslist', function () {
        return view('task.deletedtasks');
    })->name("deletedtaskslist");

    Route::post('/createtask', [TaskController::class, "create"]);

    Route::delete('/softdelete/{id}', [TaskController::class, "softdelete"]);

    Route::post('/completetask/{id}', [TaskController::class, "completeTask"]);

    Route::post('/pendingtask/{id}', [TaskController::class, "pendingTask"]);

    Route::post('/retrivedeletedtask/{id}', [TaskController::class, "retriveDeletedTask"]);

    Route::get('/download', [TaskController::class, 'jsonFileDownload']);

    Route::get('/gettasks', [TaskController::class, "index"]);

    Route::get('/getdeletedtasks', [TaskController::class, "deletedTasksList"]);
});
