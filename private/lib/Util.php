<?php

class Util
{

    /**
     * Gets an item from an array if it exists, returns the defaultValue (null by default) otherwise.
     *
     * @param array $array the array to get value from
     * @param mixed $index the index to get from the array
     * @param mixed $defaultValue the optional defaultValue to return if the array does not have array[index]
     * @return mixed array[index] if it exists, defaultValue otherwise.
     */
    public static function arrayGet(array $array, $index, $defaultValue = null)
    {
        $indexes = self::makeSureIsArray($index);
        $data = $array;
        foreach ($indexes as $subIndex) {
            if (!isset($data[$subIndex])) {
                return $defaultValue;
            } else {
                $data = $data[$subIndex];
            }
        }

        return $data;
    }

    /**
     * Makes sure a variable is an array, and if not
     * puts the current variable in an array.
     *
     * @param mixed $variable the variable that must be an array
     * @return array the original array if $variable was an array, otherwise array($variable)
     */
    public static function makeSureIsArray($variable) : array
    {
        if (!is_array($variable)) {
            $variable = array($variable);
        }

        return $variable;
    }

    /**
     * Creates a string that outputs in a certain
     * color on a terminal.
     *
     * @param string $color the name of the color:Black, Dark, Green, Cayn, Red, Purple, Brown, Yellow, White (or Light or Dark variants)
     * @param string $string the string to put into a certain color
     * @return string a string that will output in the requested color, if the color is defined,
     *                                      the inputted string otherwise.
     */
    public static function color(string $color, string $string) : string
    {
        $colors = array(
            "Black"                 => "0;30",
            "Dark Gray"             => "1;30",
            "Blue"                  => "0;34",
            "Light Blue"            => "1;34",
            "Green"                 => "0;32",
            "Light Green"           => "1;32",
            "Cyan"                  => "0;36",
            "Light Cyan"            => "1;36",
            "Red"                   => "0;31",
            "Light Red"             => "1;31",
            "Purple"                => "0;35",
            "Light Purple"          => "1;35",
            "Brown"                 => "0;33",
            "Yellow"                => "1;33",
            "Light Gray"            => "0;37",
            "White"                 => "1;37",
        );

        if (!isset($colors[$color])) {
            return $string;
        } else {
            return "\001\033[" . $colors[$color] . "m\002" . $string . "\001\033[0m\002";
        }
    }
}
