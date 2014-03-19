<?php

namespace vood\OrderingSystem;

/**
 * Class DB
 * @package vood\OrderingSystem
 */
class DB
{
    private static $instance;

    private $dbh;

    /**
     * @param array $config
     * @return static
     */
    public static function getInstance($config = array())
    {
        if (!self::$instance) {
            self::$instance = new static($config);
        }
        return self::$instance;
    }

    /**
     * singletone implementation
     */
    private function __clone()
    {

    }

    /**
     * singletone implementation
     */
    private function __wakeup()
    {

    }

    /**
     * @param $config
     */
    private function __construct($config)
    {
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        $this->dbh = new \PDO($config['dsn'], $config['username'], $config['password'], $options);
    }


    /**
     * @param $query
     * @param array $params
     * @param array $types
     * @return array
     * @throws \PDOException
     */
    public function query($query, $params = array(), $types = array())
    {
        $stmt = $this->dbh->prepare($query);

        foreach ($params as $column => $value) {
            if (array_key_exists($column, $types)) {
                $placeholder = ':' . $column;
                $stmt->bindValue($placeholder, $value, $types[$column]);
            }
        }

        if (!$stmt->execute()) {
            throw new \PDOException(vsprintf("[SQLSTATE %s] Code %s. %s.", $stmt->errorInfo()));
        }

        return $stmt->fetchAll();
    }
}