<?php

$routes = require 'routes.php';

function routesToController ($path, $routes) {
  if (array_key_exists($path, $routes)) {
    require 'controllers/' . $routes[$path];
  } else {
    abort();
  }
}

function abort ($code = Response::NOT_FOUND) {
  http_response_code($code);
  require "views/{$code}.view.php";
  die();
}

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

routesToController($path, $routes);