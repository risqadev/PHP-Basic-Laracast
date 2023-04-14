<?php

namespace Core;

class Message {
  const NOT_FOUND = "This page doesn't exists.";
  const UNAUTHORIZED = "You don't have permission to access the requested resource.";
  private const NOTE_BODY_LENGTH = "A body of no more than :max characters is required.";
  const EMAIL_INVALID = "Please provide a valid email address.";
  private const PASSWORD_INVALID = "Please provide a password between :min and :max characters long.";

  public static function note_body_length ($max) {
    return str_replace(':max', $max, static::NOTE_BODY_LENGTH);
  }

  public static function password_invalid ($min, $max) {
    $string = str_replace(':max', $max, static::PASSWORD_INVALID);
    $string = str_replace(':min', $min, $string);
    return $string;
  }
}