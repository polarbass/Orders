<?php
class OrderService {

    public static function add($newOrder) {
        $db = ConnectionFactory::getDB();
        $order = $db->client->insert(
            array(
                "Name" => $newOrder['name'], 
                "Address" => $newOrder['address'],
                "Town" => $newOrder['town'],
                "PostalCode" => $newOrder['postalCode'],
                "Phone" => $newOrder['phone']
                ));
        return $order;
    }

}
?>