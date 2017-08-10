<?php

namespace NumberGenerator;

use RuntimeException;

class NumberGenerator
{
    protected static $chars;

    protected static $numbers = [];

    protected static $repeating = true;

    protected static $includeZero = true;

    protected static $range = [0, 9];

    function __construct(int $chars = 6, bool $repeating = true, bool $includeZero = true)
    {
        if ($chars < 1)
            throw new RuntimeException('Invalid number', 400);

        static::$chars = $chars;

        static::$repeating = $repeating;

        static::$includeZero = $includeZero;
    }

    static function generate ()
    {
        while (count(static::$numbers) < static::$chars)
        {
            $number = static::number();

            if (static::check($number))
                array_push(static::$numbers, $number);
        }

        return json_encode(static::combine());
    }

    protected static function number ()
    {
        return mt_rand(static::$range[0], static::$range[1]);
    }

    protected static function combine ()
    {
        return implode('', static::$numbers);
    }

    protected static function check(int $number)
    {
        return (
            (static::$repeating ? static::$repeating : ! in_array($number, static::$numbers)) &&
            (static::$includeZero ? static::$includeZero : in_array(0, static::$numbers))
        );
    }
}
