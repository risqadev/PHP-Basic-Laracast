<?php

$heading = 'Create Note';

$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = new Database();
  $errors = [];

  if (! Validator::string($_POST['body'], 1, 1000))
    $errors['body'] = Messages::NOTE_BODY_LENGTH;

  if (empty($errors)) {
    $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user)", [
      'body' => $_POST['body'],
      'user'=> $currentUserId
    ]);
  }
}

require 'views/note-create.view.php';