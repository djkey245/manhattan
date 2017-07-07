<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
Route::get('projects', 'IndexController@projectList');
Route::get('projects/{slug}', 'IndexController@projectCart');
Route::get('about', 'IndexController@about');
Route::get('blog', 'BlogController@index');
Route::get('blog/{slug}', 'BlogController@card');
*/

Route::get('/', 'IndexController@index');
Route::get('/register', function (){return redirect('/login');});
Route::auth();
Route::get('/home', 'HomeController@index');

//list
Route::get('/list', [
    'middleware' => 'auth',
    'uses' => 'ListController@index']);
Route::get('/office/{office}', [
    'middleware' => 'auth',
    'uses' => 'ListController@office']);
Route::get('/list/{slug}/', [
     'middleware' => 'auth',
     'uses' => 'ListController@card']);
Route::post('/upload/list_add_reg',  [
     'middleware' => 'auth',
     'uses' =>'ListController@register']);
Route::post('/upload/list_add_reg_a',   [
    'middleware' => 'auth',
    'uses' =>'ListController@register_a']);
Route::post('/upload/list_add',   [
    'middleware' => 'auth',
    'uses' =>'ListController@list_add']);
Route::post('/upload/list_edit/{id}',   [
    'middleware' => 'auth',
    'uses' =>'ListController@list_edit']);
Route::post('/upload/list_delete/{id}',   [
    'middleware' => 'auth',
    'uses' =>'ListController@delete']);
Route::post('/upload/list_edit_edit',   [
    'middleware' => 'auth',
    'uses' =>'ListController@updater']);
Route::post('/upload/list_edit_edit_a',   [
    'middleware' => 'auth',
    'uses' =>'ListController@updater_a']);
Route::post('/list/search',   [
    'middleware' => 'auth',
    'uses' =>'ListController@search']);
Route::post('/list/page_search',   [
    'middleware' => 'auth',
    'uses' =>'ListController@page_search']);


//card
Route::post('/list/card_edit/{slug}', [
    'middleware' => 'auth',
    'uses' => 'ListController@card_edit']);
Route::post('/card/comment_page_add/{id}', [
    'middleware' => 'auth',
    'uses' => 'CardController@comment_page_add']);
Route::post('/card/comment_add', [
    'middleware' => 'auth',
    'uses' => 'CardController@comment_add']);

//history
Route::get('/history', [
    'middleware' => 'auth',
    'uses' => 'IndexController@history_page']);



//users
Route::get('/users',   [
    'middleware' => 'auth',
    'uses' =>'IndexController@users']);
Route::post('/user_add',   [
    'middleware' => 'auth',
    'uses' =>'IndexController@register']);
Route::post('/user_edit',   [
    'middleware' => 'auth',
    'uses' =>'IndexController@edit']);
Route::post('/delete_user/{id}',   [
    'middleware' => 'auth',
    'uses' =>'IndexController@delete']);
Route::post('/upload/add_user',   [
    'middleware' => 'auth',
    'uses' =>function (){return view('list.ajax.add_user');}]);
Route::post('/upload/edit_user/{id}',   [
    'middleware' => 'auth',
    'uses' =>'IndexController@userAjax']);

//release
Route::get('/release',   [
    'middleware' => 'auth',
    'uses' =>'ReleaseController@index']);
Route::post('/upload/release_add/{id}',   [
    'middleware' => 'auth',
    'uses' =>'ReleaseController@add_release']);
Route::post('/upload/release_add_reg',   [
    'middleware' => 'auth',
    'uses' =>'ReleaseController@add_release_reg']);
Route::post('/upload/release_edit/{id}',   [
    'middleware' => 'auth',
    'uses' =>'ReleaseController@edit_release_list']);
Route::post('/upload/release_edit_reg',   [
    'middleware' => 'auth',
    'uses' =>'ReleaseController@edit_release']);
Route::post('/delete_release/{id}',   [
    'middleware' => 'auth',
    'uses' =>'ReleaseController@deleter']);

//menu
Route::get('/menu',   [
    'middleware' => 'auth',
    'uses' =>'MenuController@index'] );
Route::post('/menu/page_add',   [
    'middleware' => 'auth',
    'uses' =>'MenuController@page_add' ]);
Route::post('/menu/page_edit/{name_eng}',   [
    'middleware' => 'auth',
    'uses' =>'MenuController@page_edit' ]);
Route::post('/menu/add',   [
    'middleware' => 'auth',
    'uses' =>'MenuController@add' ]);
Route::post('/menu/delete/{id}',   [
    'middleware' => 'auth',
    'uses' =>'MenuController@delete' ]);
Route::post('/menu/edit',   [
    'middleware' => 'auth',
    'uses' =>'MenuController@edit' ]);


//reports
Route::get('/report',   [
    'middleware' => 'auth',
    'uses' =>'ReportController@index'] );
Route::post('/report/add_page',   [
    'middleware' => 'auth',
    'uses' =>'ReportController@page_add'] );
Route::post('/report/add_page/{office}',   [
    'middleware' => 'auth',
    'uses' =>'ReportController@page_add_1'] );
Route::post('/report/report_add',   [
    'middleware' => 'auth',
    'uses' =>'ReportController@report_add'] );
Route::post('/report/report_add_next/{office}',   [
    'middleware' => 'auth',
    'uses' =>'ReportController@report_add_next'] );
