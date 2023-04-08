<?php

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
  '/' => 'index.php',
  '/about' => 'about.php',
  '/contact' => 'contact.php'
];

function routesToController($path, $routes) {
  if (array_key_exists($path, $routes)) {
    require 'controllers/' . $routes[$path];
  } else {
    abort();
  }
}

function abort ($code = 404) {
  http_response_code($code);
  require "controllers/abort/{$code}.php";
  die();
}

routesToController($path, $routes);