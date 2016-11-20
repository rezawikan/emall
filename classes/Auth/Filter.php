<?php

namespace Emall\Auth;

class Filter
{
    public static function EmailFilter($email)
    {

    }

    public static function StringFilter($string)
    {
      $result = filter_var($string, FILTER_SANITIZE_STRING);
      return $result;
    }

    public static function IntegerFilter($integer)
    {
      $result  = filter_var($integer,FILTER_VALIDATE_INT);
      return $result;
    }

    public static function FloatFilter($float)
    {

    }

    public static function BooleanFilter($boolean)
    {

    }

    public static function URLFilter($url)
    {

    }
}
