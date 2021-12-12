<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// ApiFileController
Route::post('/file/upload', [App\Http\Controllers\api\ApiFileController::class, 'upload']);

//ApiUsersController
Route::post('/users/add', [App\Http\Controllers\api\ApiUsersController::class, 'add']);
Route::post('/users/login', [App\Http\Controllers\api\ApiUsersController::class, 'login']);
Route::get( '/users/count', [App\Http\Controllers\api\ApiUsersController::class, 'userCount']);
// ApiTasksController
Route::post('/tasks/delete', [App\Http\Controllers\api\ApiTasksController::class, 'delete']);
Route::post('/tasks/update', [App\Http\Controllers\api\ApiTasksController::class, 'update']);
Route::get( '/tasks/show', [App\Http\Controllers\api\ApiTasksController::class, 'show']);
Route::get('/tasks/list', [App\Http\Controllers\api\ApiTasksController::class, 'list']);
Route::post('/tasks/create', [App\Http\Controllers\api\ApiTasksController::class, 'create']);
//TestController
Route::post('/test/test1', [App\Http\Controllers\TestController::class, 'test1']);
//
Route::get('/hello', function () {
    return 'Hello Next.js, from Laravel API';
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
