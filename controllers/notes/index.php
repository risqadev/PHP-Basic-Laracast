<?php

$currentUserId = 1;

$db = new Database();

$notes = $db->query("select id, body, user_id from notes where user_id = :id", [
  ':id' => $currentUserId
])->findAll();
  
view('notes/index.view.php', [
  'heading' => 'My Notes',
  'notes' => $notes
]);