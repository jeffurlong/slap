<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
if ( ! Request::subdomain() )
{
    Route::get('/', function()
    {
            return View::make('www.index');
    });
}

Route::group(array('before' => 'tenant'), function()
{
    Route::get('admin/login',               'Controllers\Admin\SessionController@login');
    Route::post('admin/login',              'Controllers\Admin\SessionController@attempt');
    Route::get('admin/forgot',              'Controllers\Admin\SessionController@forgot');
    Route::post('admin/forgot',             'Controllers\Admin\SessionController@remind');
    Route::get('admin/recover/{token}',     'Controllers\Admin\SessionController@recover');
    Route::post('admin/recover/{token}',    'Controllers\Admin\SessionController@reset');
    Route::get('admin/logout',              'Controllers\Admin\SessionController@logout');

    Route::group(array('prefix' => 'admin'), function()
    {
        Route::get('/',                 'Controllers\Admin\DashboardController@getIndex');
        Route::controller('dashboard',  'Controllers\Admin\DashboardController');
        Route::resource('pages',        'Controllers\Admin\PageController');

        Route::group(array('prefix' => 'settings'), function()
        {
            Route::controller('staff', 'Controllers\Admin\StaffController');
        });

    });

    Route::get('{slug?}', 'Controllers\Tenant\PageController@findBySlug');
});
