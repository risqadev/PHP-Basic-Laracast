<?php

namespace Core;

class ValidationException extends \Exception
{
  private function __construct(
    public readonly array $errors,
    public readonly array $old
  ) {
  }

  public static function throw(array $errors, array $old)
  {
    throw new static($errors, $old);
  }
}
