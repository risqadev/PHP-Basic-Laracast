<?php

namespace Http\Forms;

use Core\Message;
use Core\Validator;

class NoteForm
{
  private $minNoteLength = 5;
  private $maxNoteLength = 1000;
  private $errors = [];

  public function validate($body)
  {
    if (! Validator::string($body, $this->minNoteLength, $this->maxNoteLength)) {
      $this->errors['body'] = Message::note_body_length(number_format($this->maxNoteLength));
    }

    return empty($this->errors);
  }

  public function getErrors()
  {
    return $this->errors;
  }

  public function setError($field, $message)
  {
    $this->errors[$field] = $message;
  }
}
