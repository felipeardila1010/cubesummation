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
            'test_cases' => 'required|test_cases'
        ];
    }
}