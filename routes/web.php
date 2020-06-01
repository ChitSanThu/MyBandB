<?php

Route::get('/', 'Auth\LoginController@show');
Route::post('/', 'Auth\LoginController@login');

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
    Route::get('/test/{id}','FrontdeskController@deptInfo');
    Route::get('checkout/{id}/{state}','FrontdeskController@guestState');
    Route::get('delete/rooms', 'RoomOperation@showForDelete');
    Route::post('delete/rooms', 'RoomOperation@deleteRooms');
    Route::get('delete/room/{id}', 'RoomOperation@deleteRoom');
    Route::post('create/roomtype', 'RoomOperation@storeRoomType');
    Route::get('report/frontdesk', 'FrontdeskController@report');
    Route::post('report/frontdesk', 'FrontdeskController@reportStore');
    Route::get('frontdesk/guest/checkout/{id}/{number}','FrontdeskController@checkoutGuest');
    Route::get('frontdesk/guest/recheckin/{id}/{number}','FrontdeskController@recheckinGuest');
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
    Route::post('order/store','Admin\OrderController@orderStore');
    Route::get('search/order/{name}','Admin\OrderController@searchItem');
    Route::get('searchById/{name}','Admin\OrderController@changeToName');
    Route::get('search/order/price/{id}','Admin\OrderController@searchPrice');

});

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {

    Route::get('roles', 'RoleController@index');
    Route::get('users/show', 'UserController@index');
    Route::get('create/roles', 'RoleController@show');
    Route::post('create/roles', 'RoleController@store');
    Route::get('{id}/edit', 'UserController@edit');
    Route::get('create/categories','OrderController@showCat');
    Route::post('create/categories','OrderController@storeCat');
    Route::get('delete/cat/{id}','OrderController@deleteCat');
    Route::get('create/order','OrderController@showOrderForm');
    Route::post('create/order','OrderController@storeOrder');
});
Route::group(array('prefix' => 'developer', 'middleware' => 'developer'), function () {

    Route::get('/', 'DeveloperController@index');
    Route::post('/', 'DeveloperController@create');
    Route::get('user/{id}/edit', 'DeveloperController@edit');
    Route::get('user/{id}/delete', 'DeveloperController@deleteUser');
    Route::post('user/{id}/edit', 'DeveloperController@update');

});


