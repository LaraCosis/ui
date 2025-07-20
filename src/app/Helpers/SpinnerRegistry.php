<?php

namespace Laracosis\Ui\Helpers;

class SpinnerRegistry
{
    protected static $methods = null;

    public static function setMethods($methods = null)
    {
        // null o ['*'] = "todos los métodos"
        self::$methods = $methods;
    }

    public static function getMethods()
    {
        return self::$methods;
    }

    public static function match($method)
    {
        if (empty(self::$methods) || self::$methods === ['*'] || is_null(self::$methods)) {
            return true; // "Todos los métodos"
        }
        return in_array($method, self::$methods);
    }
}
