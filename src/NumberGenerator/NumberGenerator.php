<?php

namespace NumberGenerator;

/**
 * 1-10 digits Pin generator.
 *
 * @author 'Tunde <tunde1990@gmail.com>'
 */
class NumberGenerator
{
    protected static $chars;

    protected static $numbers = [];

    protected static $repeating = true;

    protected static $includeZero = true;

    protected static $range;

    /**
     * Contructor setting the initial number of characters to expect.
     *
     * @param integer $chars
     */
    function __construct(int $chars = 6)
    {
        static::setRange();
        static::setChars($chars);
    }

    protected static function setRange()
    {
        static::$range = range(0, 9);
    }

    /**
     * Set the number of characters that will be present in the pin.
     *
     * @param int $chars Number of characters.
     */
    protected static function setChars(int $chars)
    {
        if ($chars < 1)
            static::$chars = 1;

        else if ($chars > 10)
            static::$chars = 10;

        else static::$chars = $chars;
    }

    /**
     * Set repeating characters if characters can be repeated.
     *
     * @param boolean $repeating
     */
    static function repeatCharacters(bool $repeating = true)
    {
        static::$repeating = $repeating;
    }

    /**
     * If you want zero to be included.
     * Setting this to 'false' will make the number of characters that can be
     * generated less than 10.
     *
     * @param boolean $includeZero [description]
     */
    static function includeZero(bool $includeZero = true)
    {
        if (! $includeZero)
            static::remove(0);
    }

    /**
     * Run the generator. Returns string to accomodate a zero-leading digits.
     *
     * @return string String of pin.
     */
    static function generate ()
    {
        while (count(static::$numbers) < static::$chars)
        {
            $number = static::number();

            array_push(static::$numbers, $number);
            if (! static::$repeating)
                static::remove($number);
        }

        return static::combine();
    }

    /**
     * Generate a new number.
     *
     * @return int
     */
    protected static function number ()
    {
        return array_rand(static::$range);
    }

    /**
     * Combine array of generated numbers into a single string.
     *
     * @return string
     */
    protected static function combine ()
    {
        return (string) implode('', static::$numbers);
    }

    /**
     * Remove characters if the repeating is set to false,
     * or zero if it is not included.
     *
     * @param  int    $number
     * @return void
     */
    protected static function remove(int $number)
    {
        $key = array_search($number, static::$range);
        unset(static::$range[$key]);
        array_values(static::$range);
    }
}
