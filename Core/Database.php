<?php

namespace Core;

use PDO;

class Database {
  private $connection;
  private $statement;

  private function loadConfig () {
    $dbConfig = require base_path('config.php');
    return $dbConfig['database'];
  }

  public function __construct ($config = NULL, $user = NULL, $password = NULL) {
    if (! $config)
      $config = $this->loadConfig();

    if (! $user)
      $user = $config['user'] ?? 'root';

    if (! $password)
      $password = $config['password'] ?? '';

    $dsn = 'mysql:' . http_build_query($config, '', ';');

    $this->connection = new PDO($dsn, $user, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  public function query ($query, $params = []) {
    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);
    return $this;
  }

  public function find () {
    return $this->statement->fetch();
  }

  public function findOrFail () {
    $result = $this->find();
    if (! $result) abort();
    return $result;
  }

  public function findAll () {
    return $this->statement->fetchAll();
  }
}