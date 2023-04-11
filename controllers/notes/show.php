<?php

use Core\Database;

$currentUserId = 1;

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'DELETE') {
  $note = $db->query('SELECT id, body, user_id FROM notes WHERE id = :id', [
    'id' => $_POST['id']
  ])->findOrFail();
  
  authorize($note['user_id'] === $currentUserId);

  $db->query('DELETE FROM notes WHERE id = :id', [
    'id' => $_POST['id']
  ]);

  header('location: /notes');
  exit();
} else {
  $note = $db->query('SELECT id, body, user_id FROM notes WHERE id = :id', [
    'id' => $_GET['id']
  ])->findOrFail();
  
  authorize($note['user_id'] === $currentUserId);
  
  view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
  ]);
}
