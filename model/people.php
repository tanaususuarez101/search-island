<?php

require_once("database.php");


class people {


    public function getPeople () {
        $db = database::connect();
        $request = $db->query("SELECT * FROM people;");

        if ( $request ) {

            $request->setFetchMode( PDO::FETCH_OBJ );
            $rows = $request->fetchAll(PDO::FETCH_OBJ);

            return $rows;

        }
    }

    public function setPeople ($name, $email, $island) {
        $db = database::connect();
        $request = $db->prepare( "INSERT INTO people (id,name,email,island) VALUES (?,?,?,?)" );
        $order = $request->execute(array("",$name,$email,$island));

        if ( ! $order ) echo print_r($request->errorInfo(),true);


    }


}
