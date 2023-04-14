<?php

use Core\App;
use Core\Database;
use Core\Message;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
  $errors['email'] = Message::EMAIL_INVALID;
}

if (!Validator::string($password, 7, 64)) {
  $errors['password'] = Message::password_invalid(7, 64);
}

if (! empty($errors)) {
  return view('registration/create.view.php', [
    'errors' => $errors
  ]);
}

$db = App::resolve(Database::class);

$user = $db->query('SELECT id, email FROM users WHERE email = :email', [
  'email' => $email
])->find();

if ($user) {
  header('location: /login');
  exit();
}

$db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
  'email' => $email,
  'password'=> $password
]);

$_SESSION['user'] = [
  'email' => $email
];

header('location: /');
exit();
