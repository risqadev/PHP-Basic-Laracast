<?php

namespace Core;

class Validator {
  public static function string ($value, $min = 1, $max = INF) {
    $value = trim($value);
    $length = strlen($value);
    return $length >= $min && $length <= $max;
  }

  public static function email ($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }
}