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

Route::group( array('before' => 'tenant'), function()
{
    Route::controller('account', 'Controllers\Tenant\AccountController');

    Route::get('{slug?}', 'Controllers\Tenant\PageController@findBySlug');
});
