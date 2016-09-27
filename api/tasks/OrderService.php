<?php
class OrderService {

    public static function add($newOrder) {
        $db = ConnectionFactory::getDB();
        $order = $db->client->insert(
            array('Name' => 'name', 'Address' => 'address', 'Town' => 'town', 'PostalCode' => 'postalCode', 'Phone' => 'phone'));
        return $order;
    }
    
    public static function add2($newOrder) {
        $db = ConnectionFactory::getDB();
        $order = $db->inserttable->insert(
            array('Name' => $newOrder['name'], 'description' => $newOrder['town']));
        return $order;
    }

    public static function add3($newOrder) {
        echo " yo ";

            $dbhost = 'localhost';
            $dbuser = 'akuarelleOrders';
            $dbpass = 'admin123';
            $dbname = 'akuarelleorders';

            $connection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

            $sql = "INSERT INTO inserttable (name, description) VALUES ('name', 'town')";
            $connection->exec($sql);
            echo "new record created";
    }

}
?>