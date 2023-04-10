<?php

$heading = 'Note';

$currentUserId = 1;

$db = new Database();

$note = $db->query("select id, body, user_id from notes where id = :id", [
  'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

require 'views/note.view.php';