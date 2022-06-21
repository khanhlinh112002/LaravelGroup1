<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SumController;
use App\Http\Controllers\FormValidationController;
use App\Http\Controllers\PController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DatabaseController;




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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/homepage', [UserController::class, 'hello']);
// // Route::get('tinhtong',[SumController::class ,'tinhtong']);
// Route::get('tinhtong',function () {
//     return view('sum');
// });
// Route::post('tinhtong',[SumController::class ,'tinhtong']);

// Route::group(['prefix'=>'MyGroup'],function(){
//     Route :: get('User1',function(){
//         echo "User1";
//     });
//     Route :: get('User2',function(){
//         echo "User2";
//     });
//     Route :: get('User3',function(){
//         echo "User3";
//     });
// });
// Route::get('signup',[FormValidationController::class, 'index']);
// Route::post('signup',[FormValidationController::class, 'displayInfor']);
Route::get('/',[PagesController::class, 'index']);
Route::get('/delete{id}',[PagesController::class, 'destroy']);
Route::post('/',[PagesController::class, 'addRooms']);
// Route::get('/',[PagesController::class, 'displayInfor']);

// Route::get('/homepage',[PController::class, 'getIndex']);
// Route::get('/',[DatabaseController::class,'getAllData']);
    


