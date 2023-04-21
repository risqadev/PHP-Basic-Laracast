<?php

use Core\App;
use Core\Database;
use Core\Message;
use Core\Session;
use Http\Forms\NoteForm;

$currentUserId = Session::get('user')['id'];

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

Session::flash('errors', $form->getErrors());

redirect('/notes/create');
