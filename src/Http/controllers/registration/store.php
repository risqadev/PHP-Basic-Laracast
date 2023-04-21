<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Message;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
  if (! (new Authenticator())->isUser($email)) {
    try {
      App::resolve(Database::class)->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password'=> password_hash($password, PASSWORD_BCRYPT)
      ]);
    } catch (\Throwable $th) {
      abort(500);
    }

    redirect('/login');
  }
}

$form->setError('email', Message::EMAIL_EXISTS);

return view('registration/create.view.php', [
  'errors' => $form->getErrors()
]);
