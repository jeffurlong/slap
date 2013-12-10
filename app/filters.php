<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    // Production must me secure
	if ( ! Request::secure() and App::environment() === 'production')
    {
        return Redirect::secure(Request::fullUrl());
    }

});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});

Route::filter('auth-admin', function()
{
    if (Auth::guest())
    {
        return Redirect::guest('admin/login');
    }
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Tenant Filter
|--------------------------------------------------------------------------
|
| Tenants must be activated in order to be visible
|
*/
Route::filter('tenant', function()
{
    if ( ! in_array(Request::subdomain(), Config::get('app.subdomains')) )
    {
        App::abort(404);
    }

    if (Session::has('tenant'))
    {
        if (! Session::get('tenant.active'))
        {
            var_dump(Session::get('tenant'));
            die('soon');
        }

        return null;
    }

    Session::put('tenant', App::make('Slap\Repositories\Interfaces\Setting')->getSessionData());

    return null;

});
