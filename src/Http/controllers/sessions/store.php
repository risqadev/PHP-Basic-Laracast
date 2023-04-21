<?php

use Core\Authenticator;
use Core\Message;
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

return view('sessions/create.view.php', [
  'errors' => $form->getErrors()
]);
