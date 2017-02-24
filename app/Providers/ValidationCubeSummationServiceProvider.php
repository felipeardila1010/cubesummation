<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

class ValidationCubeSummationServiceProvider extends ServiceProvider
{
    public function boot()
    {
    	$routeValidationsInputTestCase = 'App\Validations\InputTestCase\\';

        Validator::extend('test_cases',$routeValidationsInputTestCase . 'TestCasesValidation@input');
    }
    
    public function register()
    {
        //
    }
}