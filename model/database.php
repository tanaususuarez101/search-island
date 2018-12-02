<?php
/**
 * Created by PhpStorm.
 * User: Tana
 * Date: 15/11/2018
 * Time: 20:52
 */

include_once("config/db.php");

Class database {


    public function connect(){


        try {
            $conection = new PDO("mysql:host=" .DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
            return $conection;
        } catch (PDOException $e) {
            echo "<h3>Conection failed: " .$e->getMessage(). "</h3>";
        }

    }
}


