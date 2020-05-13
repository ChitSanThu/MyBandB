<?php

Route::get('/', 'Auth\LoginController@show');
Route::post('/', 'Auth\LoginController@login');
Route::get('staff/register', 'Auth\RegisterController@show');
Route::post('staff/register', 'Auth\RegisterController@register');
Route::get('staff/logout', 'Auth\LoginController@logout');
Route::get('guest/{id}/show', 'FrontdeskController@deptInfo');
Route::group(array('prefix' => 'housekeeping', 'middleware' => 'housekeeping'), function () {
    Route::get('index', 'HousekeepingController@index');
    Route::post('index', 'HousekeepingController@update');
    Route::get('index/sent/{auth_id}','HousekeepingController@sentNotiHousekeeper');
    Route::get('index/room/{number}','HousekeepingController@housekeepingRoom');
});

Route::group(array('prefix' => 'user', 'middleware' => 'user'), function () {
    Route::get('month/{state}','FrontdeskController@month');
    Route::get('frontdesk', 'FrontdeskController@index');
    Route::post('frontdesk', 'FrontdeskController@store');
    Route::post('invoice/{id}/edit', 'FrontdeskController@logoStore');
    Route::post('invoice/print', 'FrontdeskController@invoicePrint');
    Route::get('invoice/{id}/edit', 'FrontdeskController@invoice');
    Route::get('create/rooms', 'RoomOperation@room');

    Route::post('create/rooms', 'RoomOperation@storeRoom');
    Route::get('create/roomtype', function () {
        return view('room_operation.type');
    });
    Route::get('delete/rooms', 'RoomOperation@showForDelete');
    Route::post('delete/rooms', 'RoomOperation@deleteRooms');

    Route::get('delete/room/{id}', 'RoomOperation@deleteRoom');


    Route::post('create/roomtype', 'RoomOperation@storeRoomType');
    Route::get('report/frontdesk', 'FrontdeskController@report');
    Route::post('report/frontdesk', 'FrontdeskController@reportStore');

    Route::get('frontdesk/guest/checkout/{id}/{number}','FrontdeskController@checkoutGuest');
    Route::get('frontdesk/guest/cancleguest/{id}/{number}','FrontdeskController@cancleGuest');
    Route::get('frontdesk/show/{id}','FrontdeskController@showGuest');
    Route::get('room/{state}/{number}','FrontdeskController@roomStateChange');
    Route::get('housekeeping/{user_id}/{number}/{auth_id}','FrontdeskController@housekeeping');
    Route::get('debt/{id}','FrontdeskController@paymentDebt');
    Route::get('guest_comment/{created_at}','FrontdeskController@guestComment');
    Route::get('noti/{id}','FrontdeskController@sentNotiFrontdesk');
    Route::get('report/{start}/{end}','FrontdeskController@reportMethod');
    Route::get('frontdesk/search','FrontdeskController@search');
    Route::get('frontdesk/findguest','FrontdeskController@findGuest');


});

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {

    Route::get('roles', 'RoleController@index');
    Route::get('users/show', 'UserController@index');
    Route::get('create/roles', 'RoleController@show');
    Route::post('create/roles', 'RoleController@store');
    Route::get('users/{id}/edit', 'RoleController@edit');
    Route::post('users/{id}/edit', 'RoleController@update');
    Route::get('{id}/edit', 'UserController@edit');
});


