<?php

namespace vood\OrderingSystem\Model;

class Product extends ModelAbstract
{
    const TABLE_NAME = 'products';

    protected $types = array(
        'id' => \PDO::PARAM_INT,
        'name' => \PDO::PARAM_STR,
        'description' => \PDO::PARAM_STR,
        'width' => \PDO::PARAM_INT,
        'height' => \PDO::PARAM_INT,
        'length' => \PDO::PARAM_INT,
        'value' => \PDO::PARAM_INT,
    );

    public function create($params = array())
    {
        $sql = "INSERT INTO products (name, description, width, height, length, value) VALUES (:name, :description, :width, :height, :length, :value)";
        $this->query($sql, $params);
    }

    public function update($id, $params = array())
    {
        $sql = "UPDATE products SET
            name = :name,
            description = :description,
            width = :width,
            height = :height,
            length = :length,
            value = :value
            WHERE id = :id";

        $params['id'] = $id;
        return $this->query($sql, $params);
    }

}