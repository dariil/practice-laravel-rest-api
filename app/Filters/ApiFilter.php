<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter{
    protected $safeParms = [];

    protected $columnMap = [];

    protected $operatorsMap = [];

    public function transform(Request $request){
        $eloQuery = [];

        foreach($this->safeParms as $parm => $operators){
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorsMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}