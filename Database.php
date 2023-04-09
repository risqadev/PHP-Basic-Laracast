<?php

class Database {
  public $connection;

  public function __construct ($config, $user = NULL, $password = NULL) {
    $usr = !!$user ? $user : (!!$config['user'] ? $config['user'] : 'root');
    $psw = !!$password ? $password : (!!$config['password'] ? $config['password'] : '');

    $dsn = 'mysql:' . http_build_query($config, '', ';');

    $this->connection = new PDO($dsn, $usr, $psw, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  public function query ($query, $params = []) {
    $statement = $this->connection->prepare($query);
    $statement->execute($params);
    return $statement;
  }
}