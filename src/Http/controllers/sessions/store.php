<?php

use Core\Authenticator;
use Core\Message;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
  if ((new Authenticator())->attempt($email, $password)) {
    redirect('/');
  }

  $form->setError('email', Message::USER_NOT_FOUND);
}

Session::flash('errors', $form->getErrors());
Session::flash('old', [
  'email' => $email
]);

redirect('/login');
