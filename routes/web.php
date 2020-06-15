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

    Route::get('/', function () {
        return view('auth.login');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    route::middleware(["auth","admin"])->namespace('Admin')->group(function(){
        //specialty
        Route::get('/specialties', 'SpecialtyController@index');
        Route::get('/specialties/create', 'SpecialtyController@create');
        Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');

        Route::post('/specialties', 'SpecialtyController@store');
        Route::put('/specialties/{specialty}', 'SpecialtyController@update');
        Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');

        //doctors
        Route::resource('doctors', 'DoctorController');

        //patienrs
        Route::resource('patients', 'PatientController');
    });

    route::middleware(["auth","doctor"])->namespace('Doctor')->group(function(){
        //specialty
        Route::get('/schedule', 'ScheduleController@edit');
        Route::post('/schedule', 'ScheduleController@store');
       
    });

    Route::middleware(['auth'])->group(function(){ 
        Route::get('/appointments/create', 'AppointmentController@create');
        Route::post('/appointments', 'AppointmentController@store');

        Route::get('/specialties/{specialty}/doctors','Api\SpecialtyController@doctors');
        Route::get('/schedule/hours','Api\ScheduleController@hours');
    });


