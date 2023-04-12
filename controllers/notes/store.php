<?php

use Core\Database;
use Core\Validator;
use Core\Message;

$currentUserId = 1;

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000))
  $errors['body'] = Message::NOTE_BODY_LENGTH;

if (empty($errors)) {
  $db = new Database();

  $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user)', [
    'body' => $_POST['body'],
    'user'=> $currentUserId
  ]);

  header('location: /notes');
  exit();
}

view('notes/create.view.php', [
  'heading' => 'Create Note',
  'errors' => $errors
]);