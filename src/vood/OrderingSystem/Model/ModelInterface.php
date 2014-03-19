<?php

namespace vood\OrderingSystem\Model;

interface ModelInterface
{

    public function select($filter = array());

    public function get($id);

    public function create($params = array());

    public function delete($id);

    public function update($id, $params = array());
}