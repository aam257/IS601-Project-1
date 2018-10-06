<?php
/**
 * Created by PhpStorm.
 * User: aniket
 * Date: 10/6/18
 * Time: 10:18 AM
 */

main::start("TableExample.csv");

class main{

    static public function start($filename){

        $records = csv::getRecords($filename);
        $table = html::generateTable($records);
        echo $table;

    }
}


class html{

    public static function generateTable($records){

        $count = 0;
        $table = self::returnHTMLHeader();
        foreach ($records as $record){
            $array = $record->returnArray();
            if($count == 0){
                $fields = array_keys($array);
                $table = self::returnLoopString($fields, $table);

            }
            $values = array_values($array);
            $table = self::returnLoopString($values, $table);
            $count++;
        }
        $table.='</table></body></html>';
        return $table;

    }

    public static function returnHTMLHeader(){
        $table = '<!DOCTYPE html><html lang="en"><head><link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script></head><body><table class="table table-bordered table-striped">';
        return $table;
    }

    public static function returnLoopString($array,$table){
        $table.='<tr>';
        foreach($array as $value){
            $table .= $value;
        }
        $table.='</tr>';
        return $table;
    }


}


class csv{
    static public function getRecords($filename){

        $file = fopen($filename, "r");
        $fieldNames = array();
        $count = 0;
        while(! feof($file)){

            $record = fgetcsv($file);
            if($count == 0){
                $fieldNames = $record;

            } else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }

        fclose($file);
        return $records;
    }


}




class record{

    public function __construct(Array $fieldNames = null, $values = null ){

        $record = array_combine( $fieldNames, $values);
        foreach ($record as $property => $value){
            $this->createProperty($property, $value);
        }
    }

    public function returnArray(){

        $array = (array) $this;
        return $array;
    }

    public function createProperty($name = 'first', $value = 'John'){
        $name = '<th>' . $name . '</th>';
        $value = '<td>'.$value. '</td>';
        $this->{$name} = $value;
    }
}

class recordFactory{
    public static function create(Array $fieldNames = null, Array $values = null){

        $record = new record($fieldNames, $values);
        return $record;
    }

}