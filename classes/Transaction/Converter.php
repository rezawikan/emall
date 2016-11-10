<?php

namespace Emall\Transaction;

class Converter
{
  public static function convertToIDR($value)
  {
    $value = "IDR " . number_format($value,0,',','.');
    return $value;
  }

  public static function toInteger($string)
  {
    return $value = str_replace(".","",$string);
  }

}
