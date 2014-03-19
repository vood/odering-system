<?php

namespace vood\OrderingSystem\Model;

use vood\OrderingSystem\DB;

/**
 * Class ModelAbstract
 * @package vood\OrderingSystem\Model
 */
abstract class ModelAbstract implements ModelInterface
{
    protected $types = array();

    /**
     * @var \vood\OrderingSystem\DB
     */
    protected $db;

    /**
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id) {
        $sql = sprintf("DELETE FROM %s WHERE id = :id", static::TABLE_NAME);
        return $this->query($sql, array('id' => $id));
    }

    /**
     * @param $id
     * @return array
     */
    public function get($id) {
        $sql = sprintf("SELECT * FROM %s WHERE id = :id LIMIT 1", static::TABLE_NAME);
        return $this->query($sql, array('id' => $id));
    }

    /**
     * @param array $filter
     * @return array
     */
    public function select($filter = array()) {
        $sql = sprintf("SELECT * FROM %s", static::TABLE_NAME);
        return $this->query($sql);
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    public function query($sql, $params = array()) {
        return $this->db->query($sql, $params, $this->types);
    }


}