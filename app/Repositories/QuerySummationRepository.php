<?php  
namespace App\Repositories;

use App\Entities\QuerySummation;

class QuerySummationRepository extends QuerySummation
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Entities\QuerySummation';
    }
}