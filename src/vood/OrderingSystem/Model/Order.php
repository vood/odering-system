<?php

namespace vood\OrderingSystem\Model;

class Order extends ModelAbstract {

    const TABLE_NAME = 'orders';

    protected $types = array(
        'id' => \PDO::PARAM_INT,
        'recipient_name' => \PDO::PARAM_STR,
        'street_address' => \PDO::PARAM_STR,
        'state' => \PDO::PARAM_STR,
        'zip' => \PDO::PARAM_INT,
        'phone' => \PDO::PARAM_STR,
        'quantity' => \PDO::PARAM_INT,
        'product_id' => \PDO::PARAM_INT,
        'city' => \PDO::PARAM_STR,
    );


    public function create($params = array()) {
        $sql = "INSERT INTO orders (recipient_name, street_address, state, zip, phone, quantity, product_id, city) VALUES (:recipient_name, :street_address, :state, :zip, :phone, :quantity, :product_id, :city)";
        return $this->query($sql, $params);
    }

    public function update($id, $params = array()) {
        $sql = "
        UPDATE orders SET
            recipient_name = :recipient_name,
            street_address = :street_address,
            state = :state,
            zip = :zip,
            phone = :phone,
            quantity = :quantity,
            product_id = :product_id,
            city = :city WHERE id = :id";
        $params['id'] = $id;
        return $this->query($sql, $params);
    }

    public function select($filter = array()) {
        $sql = "SELECT o.*, p.name as product_name from orders o inner join products p on o.product_id = p.id";
        return $this->query($sql);
    }
}