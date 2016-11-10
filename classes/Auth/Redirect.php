<?php

namespace Emall\Auth;

class Redirect
{
  public static function to($url = 'index.php')
  {
    header('Location: '. $url);
  }
}
