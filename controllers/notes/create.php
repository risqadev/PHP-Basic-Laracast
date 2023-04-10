<?php

use Core\Database;
use Core\Validator;
use Core\Message;

$currentUserId = 1;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = new Database();

  if (! Validator::string($_POST['body'], 1, 1000))
    $errors['body'] = Message::NOTE_BODY_LENGTH;

  if (empty($errors)) {
    $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user)", [
      'body' => $_POST['body'],
      'user'=> $currentUserId
    ]);
  }
}

view('notes/create.view.php', [
  'heading' => 'Create Note',
  'errors' => $errors
]);