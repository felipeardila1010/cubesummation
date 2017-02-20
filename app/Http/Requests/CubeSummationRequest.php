<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CubeSummationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'number_test_case'                  => 'number_test_case',
            'size_matrix_and_number_operations' => 'size_matrix_and_number_operations',
            'query1'                            => 'queries',
            'query2'                            => 'queries',
        ];
    }
}