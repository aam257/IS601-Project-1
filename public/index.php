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
    static public function getRecords($filename){

        $file = fopen($filename, "r");
        $fieldNames = array();
        $count = 0;
        while(! feof($file)){

            $record = fetcsv($file);
            if($count == 0){
                $fieldNames = $record;

            } else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }
    }


}

class recordFactory{
    public static function create(Array $fieldNames = null, Array $values = null){

        $record = new record($fieldNames, $values);
        return $record;
    }

}


class record{

    public function __construct(Arra $fileNames = null, $values = null ){

        $record = array_combine($fieldNames, $values);
        foreach ($records as $property => $values){
            $this->createProperty($property, $value);
        }
    }

    public function returnArray(){

        $array = (array) $this;
        return $array;
    }
}