<?php

namespace Tests\Unit\CubeSummationTest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CubeSummationTest extends TestCase
{
    public function testAllQueries()
    {
        $this->json('POST', 'api/json', [
        		'test_cases' => [
	                'number_test_case' 	=> '2',
	                'size_matrix_and_number_operations' => ['4 5','2 4'],
	                'queries' 	=> [
		                ['UPDATE 2 2 2 4','QUERY 1 1 1 3 3 3','UPDATE 1 1 1 23','QUERY 2 2 2 4 4 4','QUERY 1 1 1 3 3 3'],
		                ['UPDATE 2 2 2 1','QUERY 1 1 1 1 1 1','QUERY 1 1 1 2 2 2','QUERY 2 2 2 2 2 2']
	            	]
            	]
            ])
        	->assertStatus(200)
			->assertJson([
	            'El valor del número de casos de prueba (T) es =  2',
				'Los valores del tamaño del cubo y el número de operaciones es =  4 5',
				'resultado =  4',
				'resultado =  4',
				'resultado =  27',
				'Los valores del tamaño del cubo y el número de operaciones es =  2 4',
				'resultado =  0',
				'resultado =  1',
				'resultado =  1'
			]);
    }

	public function testQuery1()
    {
        $this->json('POST', 'api/json', [
        		'test_cases' => [
	                'number_test_case' 	=> '1',
	                'size_matrix_and_number_operations' => ['2 4'],
	                'queries' 	=> [
		                ['UPDATE 2 2 2 1','QUERY 1 1 1 1 1 1','QUERY 1 1 1 2 2 2','QUERY 2 2 2 2 2 2']
	            	]
            	]
            ])
        	->assertStatus(200)
			->assertJson([
	            'El valor del número de casos de prueba (T) es =  1',
				'Los valores del tamaño del cubo y el número de operaciones es =  2 4',
				'resultado =  0',
				'resultado =  1',
				'resultado =  1'
			]);
    }

	public function testQuery2()
    {
        $this->json('POST', 'api/json', [
        		'test_cases' => [
	                'number_test_case' 	=> '1',
	                'size_matrix_and_number_operations' => ['4 5'],
	                'queries' 	=> [
		                ['UPDATE 2 2 2 4','QUERY 1 1 1 3 3 3','UPDATE 1 1 1 23','QUERY 2 2 2 4 4 4','QUERY 1 1 1 3 3 3']
	            	]
            	]
            ])
        	->assertStatus(200)
			->assertJson([
	            'El valor del número de casos de prueba (T) es =  1',
				'Los valores del tamaño del cubo y el número de operaciones es =  4 5',
				'resultado =  4',
				'resultado =  4',
				'resultado =  27'
			]);
    }

	public function testErrorNumberCase()
    {
        $this->json('POST', 'api/json', [
        		'test_cases' => [
	                'number_test_case' 	=> '1 5'
            	]
            ])
        	->assertStatus(422);
    }

	public function testErrorSizeMatrixAndNumberOperations()
    {
        $this->json('POST', 'api/json', [
        		'test_cases' => [
	                'number_test_case' 	=> '1',
	                'size_matrix_and_number_operations' => ['4 5 5']
            	]
            ])
        	->assertStatus(422);
    }

    public function testErrorSizeQueries()
    {
        $this->json('POST', 'api/json', [
        		'test_cases' => [
	                'number_test_case' 	=> '1',
	                'size_matrix_and_number_operations' => ['4 5'],
	                'queries' 	=> [
		                ['UPDATE 2 2 2 4','QUERY 1 1 1 3 3 3']
	            	]
            	]
            ])
        	->assertStatus(422);
    }

    public function testErrorWordQuery()
    {
        $this->json('POST', 'api/json', [
        		'test_cases' => [
	                'number_test_case' 	=> '1',
	                'size_matrix_and_number_operations' => ['4 2'],
	                'queries' 	=> [
		                ['UPDATE 2 2 2 4','SELECT 1 1 1 3 3 3']
	            	]
            	]
            ])
        	->assertStatus(422);
    }
}
