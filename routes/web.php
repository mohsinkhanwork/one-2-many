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


// custome authentication



// Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
// Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
// Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
// Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
// Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


//end custom authentication



Route::group(['middleware'=> ['auth:sanctum']], function(){

Route::get('/dashboard', function () {

    return view('dashboard');
})->name('dashboard');



// PartyController with auth

Route::resource('/party', 'PartyController');
Route::get('party_candidate_Apis', 'apiController@index')->name('api.index');
Route::delete('delete_party/{id}','PartyController@deleteParty');



// end PartyController


// CandidateController

Route::resource('/candidate', 'CandidateController');
Route::get('/CreateCandidate/{partyID}', 'CandidateController@CreateCandidate')->name('candidate.CreateCandidate');
Route::get('/candidateIndex/{partyID}', 'CandidateController@can_index')->name('candidate.can_index');
Route::get('/EditCandidate/{CanID}/PartyID/{PartID}', 'CandidateController@can_edit')->name('candidate.can_edit');
Route::get('/request-for-deletion/{candidate_id}', 'CandidateController@deleteRequest')->name('candidate.deleteRequest');
Route::post('/searchCandidateID/', 'CandidateController@searchCanId')->name('candidate.searchCanId');
Route::delete('delete_candidate/{id}','CandidateController@deleteCandidate');


// end CandidateController

});

Route::any('/test_page', function() {

    return view('testpage');
});
