<?php
/**
 * Created by PhpStorm.
 * User: aniket
 * Date: 10/6/18
 * Time: 10:18 AM
 */

main::start("TableExample.csv");

class main{

    static public function start(){

        $records = csv::getRecords($filename);
        $table = html::generateTable($records);
        echo $table;

    }
}


class html{


}


class csv{


}

class recordFactory{
    public static function create(Array $fieldNames = null, Array $values = null){

        $record = new record($fieldNames, $values);
        return $record;
    }

}


class record{


}