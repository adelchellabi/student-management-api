<?php

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

Route::get('/api-docs', function () {
    $filePath = base_path('documentation/reference/api.yaml');
    return response()->file($filePath);
});

Route::get('/documentation', function () {
    return view('doc');
});
