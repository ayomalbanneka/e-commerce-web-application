<?php

class Database{
    public static $connection;

    public static function setUpConnection(){
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "Ayomalkaus#2k23", "shop", 3306);
        }
    }

    public static function iud($q) //Insert, Update, Delete
    {
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q)
    {
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }
    
}

?>