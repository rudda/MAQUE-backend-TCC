<?php
/**
 * Created by Rudda Beltrao
 * Date: 25/04/2017
 * Time: 06:44
 * Lab312 developer android  & php backend
 * www.lab312-icetufam.com.br
 * beltrao.rudah@gmail.com
 */

namespace Beltrao\WeqtApi\v1\database;

use PDO;
class Connection
{
    public static $DATABASE_NAME= "";
    public static $DATABASE_PASS= "";
    public static $DATABASE_USER= "";
    public static $DATABASE_PORT="";
    public static $DATABASE_HOST= "";


    static function connect(){

        try {
            $conn = new PDO('mysql:host='.self::$DATABASE_HOST.';dbname='.self::$DATABASE_NAME, self::$DATABASE_USER,self::$DATABASE_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            
        }

        catch(PDOException $e)
        {
            return false;
        }


    }




}