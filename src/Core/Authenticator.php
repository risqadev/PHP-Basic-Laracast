<?php

namespace Core;

class Authenticator
{
  private function getUser($email)
  {
    return App::resolve(Database::class)->query('SELECT id, email, password FROM users WHERE email = :email', [
      'email' => $email
    ])->find();
  }
  public function isUser($email)
  {
    return !! $this->getUser($email);
  }

  public function attempt($email, $password)
  {
    $user = $this->getUser($email);

    if ($user && password_verify($password, $user['password'])) {
      $this->login([
        'id' => $user['id'],
        'email' => $user['email']
      ]);

      return true;
    }

    return false;
  }

  public function login($user)
  {
    Session::put('user', [
      'id' => $user['id'],
      'email' => $user['email']
    ]);

    session_regenerate_id(true);
  }

  public function logout()
  {
    Session::destroy();
  }
}
