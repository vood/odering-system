<?php

namespace vood\OrderingSystem\Model;

use vood\OrderingSystem\DB;

/**
 * Class Factory
 * @package vood\OrderingSystem\Model
 */
class Factory {

    private $db;

    private $map = array(
      'order' => 'Order',
      'product' => 'Product'
    );

    /**
     * @param DB $db
     */
    public function __construct(DB $db) {
        $this->db = $db;
    }

    /**
     * @param $name
     * @return ModelInterface
     * @throws \InvalidArgumentException
     */
    public function model($name) {
        if(isset($this->map[$name])) {
            $model = "\\vood\\OrderingSystem\\Model\\" . $this->map[$name];
            return new $model($this->db);
        } else {
            throw new \InvalidArgumentException("$name model does not exist");
        }
    }

}