<?php

use Core\App;
use Core\Database;
use Core\Message;
use Core\Validator;

$currentUserId = 1;

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000))
  $errors['body'] = Message::note_body_length('1,000');

if (! empty($errors)) {
  return view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
  ]);
}

$db = App::resolve(Database::class);

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user)', [
  'body' => $_POST['body'],
  'user'=> $currentUserId
]);

header('location: /notes');
exit();