<?php

namespace Carc1n0gen\ShortLink;

use Carc1n0gen\ShortLink\Errors\DecodingException;

class Converter
{
    /**
     * @var string
     */
    const ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    /**
     * @var string
     */
    private $alphabet;

    /**
     * @param string $alphabet (optional)
     * @param bool $randomize (optional)
     */
    public function __construct($alphabet = null)
    {
        if (strlen($alphabet) === 1) {
            throw new \Exception('Custom alphabet must have at least 2 characters');
        }
        
        $this->alphabet = $alphabet ?: self::ALPHABET;
    }

    /**
     * @param int $num
     * @return string
     */
    public function encode($num)
    {
        if ($num < 0 || !is_int(filter_var($num, FILTER_VALIDATE_INT))) {
            throw new \Exception('$num must be a 0 or positive integer');
        } else if ($num === 0) {
            return $this->alphabet[0];
        }
        
        for ($arr = [], $base = strlen($this->alphabet); $num > 0;) {
            $rem = $num % $base;
            $num = floor($num / $base);
            $arr[] = $this->alphabet[$rem];
        }
        
        return join('', array_reverse($arr));
    }

    /**
     * @param string $string
     * @return int
     */
    public function decode($string)
    {
        // Cannot check for (!$string) because '0' is falsy valid
        if ($string === '' || $string === null) {
            throw new \Exception('Cannot decode a null or empty string');
        }

        $base = strlen($this->alphabet);
        return array_reduce(str_split($string), function ($carry, $item) use ($base) {
            $strpos = strpos($this->alphabet, $item);
            // Cannot do !$strpos because 0 is falsy and valid
            if ($strpos === false) {
                throw new DecodingException(
                    "String contained characters not present in internal alphabet"
                );
            }

            return ($carry * $base) + $strpos;
        }, 0);
    }
}
