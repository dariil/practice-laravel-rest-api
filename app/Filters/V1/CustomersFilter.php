<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter{
    protected $safeParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt', 'gte', 'lte']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorsMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];



    // public function transform(Request $request){
    //     $eloQuery = [];

    //     foreach($this->safeParms as $parm => $operators){
    //         $query = $request->query($parm);

    //         if(!isset($query)){
    //             continue;
    //         }

    //         $column = $this->columnMap[$parm] ?? $parm;

    //         foreach($operators as $operator){
    //             if(isset($query[$operator])){
    //                 $eloQuery[] = [$column, $this->operatorsMap[$operator], $query[$operator]];
    //             }
    //         }
    //     }

    //     return $eloQuery;
    // }
}