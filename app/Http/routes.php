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
//Route::get('/password', function (){
//    return view('list.password');
//});
Route::get('/tests', function (){
    return view('list.tests');
});
Route::get('/otrs', [
    'middleware' => 'auth',
    'uses' => 'OTRSAPIController@index']);

//home
Route::get('/home', 'HomeController@index');
Route::post('/home/other', [
    'middleware' => 'auth',
    'uses' => 'HomeController@other']);





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
Route::post('/list/server_edit/{slug}', [
    'middleware' => 'auth',
    'uses' => 'CardController@server_edit']);
Route::post('/list/virtual_edit_vrt/{slug}', [
    'middleware' => 'auth',
    'uses' => 'CardController@virtual_edit_vrt']);
Route::post('/list/virtual_edit_rdp/{slug}', [
    'middleware' => 'auth',
    'uses' => 'CardController@virtual_edit_rdp']);
Route::post('/list/save_virtual/{slug}', [
    'middleware' => 'auth',
    'uses' => 'CardController@virtual_save']);
Route::post('/list/save_virtual_vrt/{slug}', [
    'middleware' => 'auth',
    'uses' => 'CardController@virtual_save_vrt']);
Route::post('/list/delete_virtual/{slug}', [
    'middleware' => 'auth',
    'uses' => 'CardController@virtual_delete']);


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


//servers
Route::get('/server',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@index'] );
Route::get('/server/{id}',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@card'] );
Route::post('/server/page_add_rdp',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@page_add_rdp'] );
Route::post('/server/page_add_vrt',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@page_add_vrt'] );
Route::post('/server/page_add_1',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@page_add_1'] );
Route::post('/server/save',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@save'] );
Route::post('/server/add_virtual',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@add_virtual'] );
Route::put('/server/delete_virtual/',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@delete_virtual'] );
Route::put('/server/delete_server/',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@delete_server'] );
Route::post('/server/edit_virtual_page',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@edit_virtual_page'] );
Route::post('/server/edit_server_page',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@edit_server_page'] );
Route::post('/server/edit_virtual',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@edit_virtual'] );
Route::post('/server/edit_server',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@edit_server'] );
Route::post('/server/page_move',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@page_move'] );
Route::post('/server/moving',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@moving'] );
Route::post('/server/search',   [
    'middleware' => 'auth',
    'uses' =>'ServerController@search'] );

//contracts
Route::get('/contracts',   [
    'middleware' => 'auth',
    'uses' =>'ContractController@index'] );



























//admin
Route::get('/admin',   [
    'middleware' => 'auth',
    'uses' =>'TestMailController@index'] );
Route::POST('/admin',   [
    'middleware' => 'auth',
    'uses' =>'TestMailController@save'] );

//ROS
Route::get('/router',   [
    'middleware' => 'auth',
    'uses' =>'TestController@index'] );

//test
Route::get('/test',   [
    'middleware' => 'auth',
    'uses' =>'TestMailController@test'] );

//theme
Route::get('/theme/black/{id}',   [
    'middleware' => 'auth',
    'uses' =>'IndexController@theme_black'] );
Route::get('/theme/white/{id}',   [
    'middleware' => 'auth',
    'uses' =>'IndexController@theme_white'] );



Route::get('/casino', function (){
    return view('test.index');
});