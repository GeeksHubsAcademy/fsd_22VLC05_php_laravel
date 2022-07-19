<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return 'Bienvenido a mi app';
});

Route::get('/users', function () {
    try {
        $users = DB::table('users')
            ->select('title')
            ->get()
            ->toArray();

        return response()->json(
            [
                'success' => true,
                'message' => 'Users retrieved successfully',
                'data' => $users
            ],
            200
        );
    } catch (\Exception $exception) {
        return response()->json(
            [
                'success' => false,
                'message' => 'Error retrieving: '.$exception->getMessage()
            ],
            500
        );
    }
});

Route::post('/users', function () {
    return ['post'];
});

Route::put('/users', function () {
    return ['put'];
});

Route::delete('/users', function () {
    return ['delete'];
});

Route::get('/users/{id}', function ($id) {
    return $id;
});
