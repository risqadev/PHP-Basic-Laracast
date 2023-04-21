<?php

use Core\App;
use Core\Database;

$currentUserId = $_SESSION['user']['id'];

$notes = App::resolve(Database::class)->query("SELECT id, body, user_id FROM notes WHERE user_id = :id", [
  ':id' => $currentUserId
])->findAll();

view('notes/index.view.php', [
  'heading' => 'My Notes',
  'notes' => $notes
]);
