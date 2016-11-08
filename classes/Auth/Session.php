<?php

namespace Emall\Auth;

class Session
{
  public static function exists($name)
  {
    return (isset($_SESSION[$name])) ? true : false;
  }

  public static function set($name, $value)
  {
    return $_SESSION[$name] = $value;
  }

  public static function get($name)
  {
    return $_SESSION[$name];
  }

  public static function empty($name)
  {
    return $_SESSION[$name] = null;
  }

  public static function destroy()
  {
      return session_destroy();
  }
}
?>
