<?php

namespace vood\OrderingSystem\Model;

/**
 * Interface ModelInterface
 * @package vood\OrderingSystem\Model
 */
interface ModelInterface
{

    /**
     * @param array $filter
     * @return array
     */
    public function select($filter = array());

    /**
     * @param $id
     * @return array
     */
    public function get($id);

    /**
     * @param array $params
     * @return int
     */
    public function create($params = array());

    /**
     * @param $id
     * @return bool
     */
    public function delete($id);

    /**
     * @param $id
     * @param array $params
     * @return bool
     */
    public function update($id, $params = array());
}