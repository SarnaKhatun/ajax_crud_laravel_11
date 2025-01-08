<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProductController;

//Route::get('/', function () {
//    return view('products');
//
//});
//Route::post('/store', [EmployeeController::class, 'store'])->name('store');
//Route::get('/getall', [EmployeeController::class, 'getall'])->name('getall');
//Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
//Route::post('/employee/update', [EmployeeController::class, 'update'])->name('update');
//
//Route::delete('/employee/delete', [EmployeeController::class, 'delete'])->name('delete');

Route::get('/', [ProductController::class, 'products'])->name('products');
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update.product');
Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('delete.product');


Route::get('add-student', function () {
    return view('form');
});
Route::post('add-student', [StudentController::class, 'addStudent'])->name('add.student');
Route::get('/get-students', function () {
   return view('students');
});

Route::get('/get-all-students', [StudentController::class, 'getStudents'])->name('getStudents');
Route::get('editUser/{id}', [StudentController::class, 'getStudentData']);
Route::post('update-data', [StudentController::class, 'updateStudent'])->name('updateStudent');
Route::get('delete-data/{id}', [StudentController::class, 'deleteData']);




