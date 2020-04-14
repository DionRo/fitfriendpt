<?php

// Default Routes
Route::get('/', 'PagesController@index');
Route::get('/contact' , 'PagesController@contact');
Route::get('/trainer/{id}', 'PagesController@showTrainer');
route::post('/sendemail', 'PagesController@sendEmail');
Route::get('/success' , 'PagesController@success')->name('success');

// Appointment Routes
Route::resource('/dashboard/appointment', 'AppointmentController')->except(['create', 'show', 'edit', 'update']);
Route::post('/dashboard/appointment/check' , 'AppointmentController@appointmentAvail');

// Admin Routes
Route::get('/dashboard' , 'AdminController@index');
Route::get('/dashboard/agenda' , 'AdminController@agenda');
Route::post('/dashboard/agenda/search' , 'AdminController@agendaSearch');
Route::get('/dashboard/allOrders', 'AdminController@allOrders');
Route::get('/dashboard/payments', 'AdminController@payments');
Route::post('/dashboard/payments/store', 'AdminController@storePayment');
Route::get('/dashboard/payments/{id}/delete' , 'AdminController@deletePayment');
Route::get('/dashboard/order/{id}/showPDF' , 'AdminController@showPDF');

// Order Routes
Route::resource('/dashboard/orders', 'OrderController')->except(['create', 'edit', 'destroy', 'store']);

// User Routes
Route::resource('/dashboard/user', 'UserController')->except(['create', 'store', 'show']);;
Route::delete('/dashboard/user/delete/note/{id}', 'UserController@deleteNoteUser');
Route::post('/dashboard/user/addStats/{id}' ,'UserController@addStats');
Route::delete('/dashboard/user/deleteStat/{id}' ,'UserController@deleteStat');

// Trainer Routes
Route::resource('/dashboard/trainer' , 'TrainerController')->except(['create', 'store' ,'destroy']);

// Product Controller
Route::resource('/dashboard/product' , 'ProductController')->except(['update', 'show']);

Auth::routes();
