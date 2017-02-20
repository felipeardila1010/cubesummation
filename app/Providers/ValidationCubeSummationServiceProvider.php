<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

class ValidationCubeSummationServiceProvider extends ServiceProvider
{
    public function boot()
    {
    	$routeValidationsInputTestCase = 'App\Validations\InputTestCase\\';

        Validator::extend('number_test_case',                   $routeValidationsInputTestCase . 'NumberTestCaseValidation@input');
        Validator::extend('size_matrix_and_number_operations',  $routeValidationsInputTestCase . 'SizeMatrixAndNumberOperationsCubeValidation@input');
        Validator::extend('queries',                            $routeValidationsInputTestCase . 'QueryValidation@input');
    }
    
    public function register()
    {
        //
    }
}