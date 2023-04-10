<?php

$routes = require base_path('routes.php');

function routesToController ($path, $routes) {
  if (array_key_exists($path, $routes)) {
    require base_path("controllers/{$routes[$path]}");
  } else {
    abort();
  }
}

function abort ($code = Response::NOT_FOUND) {
  http_response_code($code);
  require base_path("views/{$code}.view.php");
  die();
}

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

routesToController($path, $routes);