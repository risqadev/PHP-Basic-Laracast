<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
  protected $routes = [];

  private function add($method, $path, $controller)
  {
    $this->routes[] = [
      'method' => $method,
      'path' => $path,
      'controller' => $controller,
      'middleware' => null,
    ];

    return $this;
  }

  public function only($key)
  {
    $this->routes[array_key_last($this->routes)]['middleware'] = $key;

    return $this;
  }

  public function get($path, $controller)
  {
    return $this->add('GET', $path, $controller);
  }

  public function post($path, $controller)
  {
    return $this->add('POST', $path, $controller);
  }

  public function delete($path, $controller)
  {
    return $this->add('DELETE', $path, $controller);
  }

  public function patch($path, $controller)
  {
    return $this->add('PATCH', $path, $controller);
  }

  public function put($path, $controller)
  {
    return $this->add('PUT', $path, $controller);
  }

  public function previousUrl()
  {
    return $_SERVER['HTTP_REFERER'];
  }

  public function route($path, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['path'] === $path && $route['method'] === strtoupper($method)) {
        Middleware::resolve($route['middleware']);

        return require base_path('Http/controllers/' . $route['controller']);
      }
    }

    abort();
  }
}
