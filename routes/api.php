<?php

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apipartyController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/party', function () {

// return Party::all();

// });

// Route::post('/party', function () {

//         return Party::create([
//             'name' => 'PTI',
//             'party_logo' => 'BAT'
//         ]);
// });

//public routes
// Route::resource('/party', 'apipartyController');
Route::get('/party', [apipartyController::class, 'index']);
Route::get('/party/{id}', [apipartyController::class, 'show']);
Route::get('/party/search/{name}', [apipartyController::class, 'search']);
// Route::post('/register', [AuthController::class,'register']);
// Route::post('/login', [AuthController::class,'login']);

Route::post('/party', [apipartyController::class, 'store']);
Route::put('/party/{id}', [apipartyController::class, 'update']);
Route::delete('/party/{id}', [apipartyController::class, 'destroy']);





//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
   

 // Route::post('/logout', [AuthController::class,'logout']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
