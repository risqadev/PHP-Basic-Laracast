<?php

namespace Core;

class Container
{
  protected $bindings = [];

  public function bind($key, $resolver)
  {
    $this->bindings[$key] = $resolver;
  }

  public function resolve($key)
  {
    $resolver = $this->bindings[$key];

    if (! $resolver) {
      throw new Exception("No matching binding for {$key}.");
    }

    return call_user_func($resolver);
  }
}
