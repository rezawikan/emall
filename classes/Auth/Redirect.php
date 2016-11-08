<?php

namespace Emall\Auth;

class Redirect
{
  public static function to($url)
  {
    header('Location: '. $url);
  }
}
