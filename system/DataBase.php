<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 31.12.20
 * Time: 14:52
 */

class DataBase
{

    const DBHOST = 'localhost';
    const DB = 'tasks';
    const DBUSER = 'root';
    const DBPASSWORD = '';

    public static function connect(){
        $dbhost = self::DBHOST;
        $db = self::DB;
        $dbuser = self::DBUSER;
        $dbpass = self::DBPASSWORD;

        try{


            $dsn = "mysql:host=$dbhost; dbname=$db";
            $dbh = new PDO($dsn, $dbuser, $dbpass);

            return $dbh;

        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

}