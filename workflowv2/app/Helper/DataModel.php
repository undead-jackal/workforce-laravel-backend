<?php

namespace App\Helper;
use Illuminate\Support\Facades\DB;

class DataModel{
    public static function getData($params = array(), $toSql = false){
        $query = DB::table($params['table']);
        if (array_key_exists('select',$params)) {
            $query->select($params['select']);
        }

        if (array_key_exists('where',$params)) {
            $query->where($params['where']);
        }
        if (array_key_exists('join',$params)) {
            foreach($params['join'] as $join){
                $query->join($join[0], $join[1], $join[2], $join[3]);
            }
        }
        if (array_key_exists('orWhere', $params)) {
                $query->orWhere($params['orWhere']);
        }
        if ($toSql) {
            return $query->toSql();
        }else{
            return $query->get();
        }
        
    }

    public static function insertData($table, $data, $toSql = false){
        return DB::table($table)
            ->insertGetId($data);
    }

    // public static function update($table, $data, $toSql = false){
    //     return DB::table($table)
    //     ->updateOrInsert(
    //         ['user' => $application->applicant,'job' =>$application->job],
    //         ['status' => 3]
    //     );
    // }
    // public static function insertData($table, $data, $toSql = false){
    //     return DB::table($table)
    // }
    

}