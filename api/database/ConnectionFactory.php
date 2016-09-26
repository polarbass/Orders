<?php
class ConnectionFactory {

    public static function getDB() {
        $connection = self::getConnection();
        $db = new NotORM($connection);
        return $db;
    }
    
    private static function getConnection() {
        $dbhost = getenv('IP');
        $dbuser = 'akuarelleOrders';
        $dbpass = 'admin123';
        $dbname = 'akuarelleorders';
        
        try {
            $connection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo " connected ";
        }
        catch(Exception $e) {
           echo $e->getMessage();
           die;
        }
        
        return $connection;
    }
}
?>