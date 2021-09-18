<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\PartyController;
use app\Http\Controllers\CandidateController;
use app\Http\Controllers\AuthController;

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



Route::group(['middleware'=> ['auth:sanctum', 'verified', 'accessrole']], function(){

Route::get('/dashboard', function () {
    
    return view('dashboard');

    })->name('dashboard');

Route::resource('/party', 'PartyController', [
            'names' => [
                'index' => 'party.index',
                // 'create' => 'party.create',
                'store' => 'party.store',
                'show' => 'party.show',
                'edit' => 'party.edit',
                'update' => 'party.update',
                'destroy' => 'party.destroy',
                ]

                ]);

Route::resource('/candidate', 'CandidateController', [
                'names' => [
                'index' => 'candidate',
                'create' => 'candidate.create', 
                'store' => 'candidate.store',
                'show' => 'candidate.show',
                'edit' => 'candidate.edit',
                'update' => 'candidate.update',
                'destroy' => 'candidate.destroy',
                ]
                
                ]);

});
