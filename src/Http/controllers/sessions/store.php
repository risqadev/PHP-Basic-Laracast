<?php

use Core\Authenticator;
use Core\Message;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password']
]);

$signedIn = (new Authenticator())->attempt($attributes);

if (! $signedIn) {
  $form->setError('email', Message::USER_NOT_FOUND)
    ->throw();
}

redirect('/');
