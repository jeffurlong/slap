<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => true,
    
     /*
    |--------------------------------------------------------------------------
    | Application Subdomains
    |--------------------------------------------------------------------------
    |
    | Application Tenants must have their subdomain registered here. Attempting to
    | access an unregistered subdomain will cause the application to abort with
    | a 404 error. (www is the default tenant).
    |
    */

    'subdomains' => array(
        'www',
        'demo',
    ),
);
