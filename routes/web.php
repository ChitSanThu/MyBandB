<?php

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

//FOR FrontdeskController OF URL
use App\CheckIn;
use App\DeptRecord;

//Route::get('/previous/month', 'FrontdeskController@previous');

//Route::get('/password/reset', function () {
//    return view('auth.passwords.reset');
//});
//Route::get("/daily/guests/{id}", "FrontdeskController@showTab");

// Route::get('/checkin/guest', function () {
//     return view('guest.guestInfo');
// });
//Route::get('daily/print', 'FrontdeskController@print_daily_guest');

//Route::get('/payment/ex', function () {
//    return view('payment');
//});

// Route::get('/',function (){
// return redirect(action('Auth\LoginController@show'));
// });
Route::get('/', 'Auth\LoginController@show');
// Route::get('staff/login','Auth\LoginController@show');
Route::post('/', 'Auth\LoginController@login');
Route::get('staff/register', 'Auth\RegisterController@show');
Route::post('staff/register', 'Auth\RegisterController@register');
Route::get('staff/logout', 'Auth\LoginController@logout');
Route::get('guest/{id}/show', 'FrontdeskController@deptInfo');


Route::group(array('prefix' => 'housekeeping', 'middleware' => 'housekeeping'), function () {

    Route::get('index', 'HousekeepingController@index');
    Route::post('index', 'HousekeepingController@update');

});


Route::group(array('prefix' => 'user', 'middleware' => 'user'), function () {
    Route::get('{col}', 'FrontdeskController@index');
    Route::post('{col}', 'FrontdeskController@store');

    Route::get('{col}/livesearch', function () {
        return view('liveSearch.liveSearch');
    });
    Route::get('{col}/search', 'FrontdeskController@search');

    Route::post('invoice/{id}/edit', 'FrontdeskController@logoStore');
    Route::post('invoice/print', 'FrontdeskController@invoicePrint');
    Route::get('invoice/{id}/edit', 'FrontdeskController@invoice');
    Route::get('create/rooms', 'RoomOperation@room');
    Route::post('create/rooms', 'RoomOperation@storeRoom');
    Route::get('create/roomtype', function () {
        return view('room_operation.type');
    });
    Route::post('create/roomtype', 'RoomOperation@storeRoomType');
    Route::get('report/frontdesk', 'FrontdeskController@report');
    Route::post('report/frontdesk', 'FrontdeskController@reportStore');



});
Route::group(array('prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'manager'), function () {
    Route::get('roles', 'RoleController@index');
    Route::get('users/show', 'UserController@index');

    Route::get('create/roles', 'RoleController@show');
    Route::post('create/roles', 'RoleController@store');
    Route::get('users/{id}/edit', 'RoleController@edit');
    Route::post('users/{id}/edit', 'RoleController@update');
    Route::get('{id}/edit', 'UserController@edit');
});


//Auth::routes();
//
//Route::get('/home', 'HomeController@index');


// for real time notification

