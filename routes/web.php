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
Route::auth();
Route::get('/', ['uses' => 'HomeController@home']);
Route::get('/home', function () {
    //return view('welcome');
    return redirect('/');
});
Route::get('/admin', function () {
    //return view('welcome');
    return redirect('/login');
});
Route::get('/about', ['uses' => 'HomeController@about']);
Route::get('/feedback', ['uses' => 'HomeController@feedback']);
Route::get('/project', 'ExploreController@index');
Route::post('/project', 'ExploreController@index');


// Route::post('/explore', 'ExploreController@index');
Route::get('/project/district{id}', 'ExploreController@district');
Route::get('/project/{id}', 'ExploreController@profile');



Route::get('/explore/status_{id}', 'ExploreController@status');
Route::get('/explore/district_{id}', 'ExploreController@district');
Route::get('/explore/category_{id}', 'ExploreController@category');
Route::get('/explore/cityagency_{id}', 'ExploreController@cityagency');
// Route::post('/search', 'ExploreController@search');
// Route::get('/filter', 'ExploreController@filterValues');

Route::get('/summary', 'SummaryController@index');

Route::post('/range', 'ExploreController@filterexplore');
Route::post('/export_csv', 'ExploreController@exportcsv');
Route::post('/download_csv', 'ExploreController@downloadcsv');

Route::post('/filter', 'SummaryController@filtersummary');
Route::post('/export_pdf', 'SummaryController@exportpdf');
Route::post('/download_pdf', 'SummaryController@download_pdf');

 Route::group(['middleware' => ['web', 'auth', 'permission'] ], function () {
        Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'home.dashboard']);

        Route::resource('pages', 'PagesController');
        //users
        Route::resource('user', 'UserController');
        Route::get('user/{user}/permissions', ['uses' => 'UserController@permissions', 'as' => 'user.permissions']);
        Route::post('user/{user}/save', ['uses' => 'UserController@save', 'as' => 'user.save']);
        Route::get('user/{user}/activate', ['uses' => 'UserController@activate', 'as' => 'user.activate']);
        Route::get('user/{user}/deactivate', ['uses' => 'UserController@deactivate', 'as' => 'user.deactivate']);
          Route::post('user/ajax_all', ['uses' => 'UserController@ajax_all']);

        //roles
        Route::resource('role', 'RoleController');
        Route::get('role/{role}/permissions', ['uses' => 'RoleController@permissions', 'as' => 'role.permissions']);
        Route::post('role/{role}/save', ['uses' => 'RoleController@save', 'as' => 'role.save']);
        Route::post('role/check', ['uses' => 'RoleController@check']);

        Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);

        Route::get('/sync_projects', ['uses' => 'ProjectController@airtable']);  
        Route::get('/sync_processes_annual', ['uses' => 'ProcessController@airtable']);
        Route::get('/sync_district-ward', ['uses' => 'DistrictController@airtable']);
        Route::get('/sync_contacts', ['uses' => 'ContactController@airtable']);
        Route::get('/sync_agency', ['uses' => 'AgencyController@airtable']);
        Route::get('/sync_community_board', ['uses' => 'CommunityController@airtable']);

        //Route::get('/tb_projects', ['uses' => 'ProjectController@index']);
        Route::resource('tb_projects', 'ProjectController');
        Route::resource('tb_processes', 'ProcessController');
        Route::resource('tb_district', 'DistrictController');
        Route::resource('tb_contacts', 'ContactController');
        Route::resource('tb_agency', 'AgencyController');

        Route::resource('layout_edit', 'EditlayoutController');
        
        Route::get('/datasync', ['uses' => 'PagesController@datasync']);
 });