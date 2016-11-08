<?php

namespace Emall\User;

class Balance
{
  public function convertToIDR($value)
  {
    $value = "IDR " . number_format($value,0,',','.');
    return $value;
  }
}
