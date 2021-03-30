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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Frontend@index');
Route::get('/login', 'Frontend@login');
Route::post('/check_login', 'Users@verify_user');

Route::get('/register', 'Frontend@register');
Route::get('register/{token}', 'Users@activate');

Route::post('/save_user', 'Users@create_user');
Route::get('/logout/', 'Users@logout');




Route::get('/notes', 'Notes@index');
Route::post('/notes/search', 'Notes@search');

Route::get('/note', 'Notes@create');
Route::post('/create_note', 'Notes@create_note');


Route::get('/note/{id}', 'Notes@update');
Route::post('/update_note', 'Notes@update_note');


Route::post('/delete_note', 'Notes@delete_note');


