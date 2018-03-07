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

    /**
     * Set repeating characters to false if characters should not be repeated.
     *
     * @param boolean $repeating
     */
    function noRepeat()
    {
        static::$repeating = false;

        return $this;
    }

    /**
     * Calling this function will remove zero(s) from the generated numbers.
     *
     * @param boolean $includeZero [description]
     */
    function noZero()
    {
        static::remove(0);
        return $this;
    }

    /**
     * Run the generator. Returns string to accomodate a zero-leading digits.
     *
     * @return string String of pin.
     */
    function generate ()
    {
        $chars = static::getChars();

        while (count(static::$numbers) < $chars)
        {
            $number = static::number();

            array_push(static::$numbers, $number);
            if (! static::$repeating)
                static::remove($number);
        }

        return static::combined();
    }

    /**
     * Set the digits from 0 to 9.
     * 
     * @return void
     */
    protected static function setRange(array $range = [])
    {
        static::$range = ! empty($range) ? $range : range(0, 9);
    }

    /**
     * Get the number ranges to be used.
     * 
     * @return array Digits.
     */
    static function getRange()
    {
        return static::$range;
    }

    /**
     * Get the number of characters to be generted.
     * 
     * @return int Chars.
     */
    static function getChars()
    {
        return static::$chars;
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
     * Generate a new number.
     *
     * @return int
     */
    protected static function number ()
    {
        $range = static::getRange();

        $number = $range[mt_rand(0, count($range) - 1)];

        return $number;
    }

    /**
     * Combine array of generated numbers into a single string.
     *
     * @return string
     */
    protected static function combined ()
    {
        $numbers = implode("", static::$numbers);
        return $numbers;
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
        $range = static::getRange();

        $key = array_search((int)$number, $range, TRUE);

        unset($range[$key]);

        static::setRange(array_values($range));
    }

    /**
     * Returns a copy of the current instance of this class.
     * 
     * @return this
     */
    function copy ()
    {
        return clone $this;
    }
}
