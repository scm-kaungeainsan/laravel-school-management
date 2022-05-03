<?php


use App\Http\Controllers\StudentsController;
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

Route::get('/add-student',[StudentsController::class, 'addStudent']);
Route::post('/create-student',[StudentsController::class, 'createStudent'])->name('student-create');
Route::get('/student',[StudentsController::class, 'getStudent'])->name('student');
Route::get('/delete-student/{id}',[StudentsController::class, 'deleteStudent']);
Route::post('/update-student',[StudentsController::class, 'UpdateStudent'])->name('student.update');