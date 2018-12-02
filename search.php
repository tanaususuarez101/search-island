<?php
/**
 * Created by PhpStorm.
 * User: Tana
 * Date: 21/11/2018
 * Time: 16:04
 */

include_once ( "model/database.php" );


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $value = (isset($_POST['input_search']))?$_POST['input_search']:"";


    $db = database::connect();
    $request = $db->query("SELECT * FROM people ORDER BY ID ASC;");



    if ( $request ) {

        $request->setFetchMode( PDO::FETCH_OBJ );
        $rows = $request->fetchAll(PDO::FETCH_OBJ); // return array two dimension

        $html = "";
        if ( $value =="" ){
            foreach ($rows as $reg) {
                $html .= "<tr><th scope='row'>$reg->id</th><td>$reg->name</td><td>$reg->email</td><td>$reg->island</td></tr>";
            }
        } else {

            foreach ($rows as $reg) {
                if ( stristr(strtolower($value), substr(strtolower($reg->name), 0, strlen($value))) ){
                    $html .= "<tr><th scope='row'>$reg->id</th><td>$reg->name</td><td>$reg->email</td><td>$reg->island</td></tr>";
                } else if ( stristr(strtolower($value), substr(strtolower($reg->island), 0, strlen($value))) ) {
                    $html .= "<tr><th scope='row'>$reg->id</th><td>$reg->name</td><td>$reg->email</td><td>$reg->island</td></tr>";
                }
            }
        }
        echo $html;


    }
}