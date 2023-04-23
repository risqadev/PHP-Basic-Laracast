<?php

namespace Http\Forms;

use Core\Message;
use Core\ValidationException;
use Core\Validator;

class LoginForm
{
  private $minPwdLength = 7;
  private $maxPwdLength = 64;

  private $errors = [];

  private function __construct(public array $attributes)
  {
    if (! Validator::email($attributes['email'])) {
      $this->errors['email'] = Message::EMAIL_INVALID;
    }

    if (! Validator::string($attributes['password'], $this->minPwdLength, $this->maxPwdLength)) {
      $this->errors['password'] = Message::password_invalid($this->minPwdLength, $this->maxPwdLength);
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);

    return $instance->hasErrors() ? $instance->throw() : $instance;
  }

  public function throw()
  {
    ValidationException::throw($this->getErrors(), $this->attributes);
  }

  public function hasErrors()
  {
    return (bool) count($this->errors);
  }

  public function getErrors()
  {
    return $this->errors;
  }

  public function setError($field, $message)
  {
    $this->errors[$field] = $message;

    return $this;
  }
}
