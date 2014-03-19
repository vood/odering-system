<?php

namespace vood\OrderingSystem\Model;

use vood\OrderingSystem\DB;

abstract class ModelAbstract implements ModelInterface
{
    protected $types = array();

    /**
     * @var \vood\OrderingSystem\DB
     */
    protected $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function delete($id) {
        $sql = sprintf("DELETE FROM %s WHERE id = :id", static::TABLE_NAME);
        return $this->query($sql, array('id' => $id));
    }

    public function get($id) {
        $sql = sprintf("SELECT * FROM %s WHERE id = :id LIMIT 1", static::TABLE_NAME);
        return $this->query($sql, array('id' => $id));
    }

    public function select($filter = array()) {
        $sql = sprintf("SELECT * FROM %s", static::TABLE_NAME);
        return $this->query($sql);
    }

    public function query($sql, $params = array()) {
        return $this->db->query($sql, $params, $this->types);
    }


}