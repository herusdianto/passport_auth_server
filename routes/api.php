<?php

use App\User;
use Illuminate\Http\Request;

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

Route::post('/register', 'Auth\RegisterController@create');

Route::group(['middleware' => ['auth:api']], function() {
   Route::get('/user', function(Request $request) {
       return $request->user();
   });

    Route::put('/user', function(Request $request) {
        $name = $request->name;
        $email = $request->email;

        $user = $request->user();
        $user->name = $name;
        $user->email = $email;

        $user->save();

        return ['success' => true, 'message' => 'Profile updated.'];
    });
});
