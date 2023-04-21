<?php

namespace Http\Forms;

use Core\Message;
use Core\Validator;

class LoginForm
{
  private $minPwdLength = 7;
  private $maxPwdLength = 64;
  private $errors = [];

  public function validate($email, $password)
  {
    if (! Validator::email($email)) {
      $this->errors['email'] = Message::EMAIL_INVALID;
    }

    if (! Validator::string($password, $this->minPwdLength, $this->maxPwdLength)) {
      $this->errors['password'] = Message::password_invalid($this->minPwdLength, $this->maxPwdLength);
    }

    return empty($this->errors);
  }

  public function getErrors()
  {
    return $this->errors;
  }

  public function setError($field, $message)
  {
    $this->errors[$field] = $message;
  }
}
