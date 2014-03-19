<?php

$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

$dsn = "mysql:host=$server;dbname=$db;";

$config = array(
  'db' => array(
      'dsn' => $dsn,
      'username' => $username,
      'password' => $password
  )
);

return $config;