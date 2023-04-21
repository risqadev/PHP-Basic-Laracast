<?php

use Core\App;
use Core\Database;
use Core\Message;
use Core\Validator;
use Http\Forms\NoteForm;

$currentUserId = $_SESSION['user']['id'];

$form = new NoteForm();

if ($form->validate($_POST['body'])) {
  try {
    App::resolve(Database::class)->query('INSERT INTO notes (body, user_id) VALUES (:body, :user)', [
      'body' => $_POST['body'],
      'user'=> $currentUserId
    ]);
  } catch (\Throwable $th) {
    abort(500);
  }

  redirect('/notes');
}

$form->setError('body', Message::note_body_length('1,000'));

return view('notes/create.view.php', [
  'heading' => 'Create Note',
  'errors' => $form->getErrors()
]);
