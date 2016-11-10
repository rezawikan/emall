<?php

namespace Emall\Transaction;

class Balance
{
  public static function convertToIDR($value)
  {
    $value = "IDR " . number_format($value,0,',','.');
    return $value;
  }

}
