<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\PartyController;
use app\Http\Controllers\CandidateController;
use app\Http\Controllers\AuthController;
use app\Http\Controllers\apiController;

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
                'create' => 'party.create',
                'store' => 'party.store',
                'show' => 'party.show',
                'edit' => 'party.edit',
                'update' => 'party.update',
                'destroy' => 'party.destroy',
                ]

                ]);

Route::resource('/candidate', 'CandidateController');

Route::get('/CreateCandidate/{partyID}', 'CandidateController@CreateCandidate')->name('candidate.CreateCandidate');
Route::get('/candidateIndex/{partyID}', 'CandidateController@can_index')->name('candidate.can_index');
Route::get('/EditCandidate/{CanID}/PartyID/{PartID}', 'CandidateController@can_edit')->name('candidate.can_edit');
Route::get('party_candidate_Apis', 'apiController@index')->name('api.index');

Route::get('/request-for-deletion/{candidate_id}', 'CandidateController@deleteRequest')->name('candidate.deleteRequest');
Route::post('/searchCandidateID/', 'CandidateController@searchCanId')->name('candidate.searchCanId');



Route::Delete('/DeleteCandidateID/{CanDelID}','CandidateController@DeleteCandidateID')->name('candidate.DeleteCandidateID');

});

Route::any('/test_page', function() {
    
    return view('testpage');
});
