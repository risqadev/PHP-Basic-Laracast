<?php

use Core\App;
use Core\Database;
use Core\Message;
use Core\Validator;

$currentUserId = 1;

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000))
  $errors['body'] = Message::NOTE_BODY_LENGTH;

if (empty($errors)) {
  $db = App::resolve(Database::class);

  $note = $db->query('SELECT id, body, user_id FROM notes WHERE id = :id', [
    'id' => $_POST['id']
  ])->findOrFail();

  authorize($note['user_id'] === $currentUserId);

  $db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
  ]);

  header("location: /note?id={$note['id']}");
  exit();
}

view('notes/edit.view.php', [
  'heading' => 'Edit Note',
  'errors' => $errors
]);