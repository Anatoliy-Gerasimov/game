<?php

declare(strict_types=1);

if (!function_exists('number_between')) {

    /**
     * Change number should be more or equal $min and less or equal $max
     *
     * @param int|float $number
     * @param int|float $min
     * @param int|float $max
     *
     * @return int|float
     */
    function number_between($number, $min, $max)
    {
        $number = max($min, $number);
        return min($max, $number);
    }
}

if (!function_exists('array_rand_value')) {

    /**
     * Return random element of array
     *
     * @param array $array
     *
     * @return mixed
     */
    function array_rand_value(array $array)
    {
        $key = array_rand($array);
        return $array[$key];
    }
}