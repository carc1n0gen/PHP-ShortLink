<?php

namespace Carc1n0gen\BaseN;

class BaseNConverter
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
    public function __construct($alphabet = null, $randomize = false)
    {
        if (strlen($alphabet) === 1) {
            throw new \Exception('Custom alphabet must have at least 2 characters');
        }
        
        $this->alphabet = $alphabet ?: self::ALPHABET;
        
        if ($randomize) {
            $this->alphabet = str_shuffle($this->alphabet);
        }
    }

    /**
     * @param int $num
     * @return string
     */
    public function encode($num)
    {
        if ($num < 0 || !is_int($num)) {
            throw new \Exception('$num must be a 0 or positive integer');
        } else if ($num === 0) {
            return $this->alphabet[0];
        }
        
        $arr = [];
        $base = strlen($this->alphabet);
        
        while ($num > 0) {
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
        if ($string === '' || $string === null) {
            // Cannot do if (!$string) because '0' is falsy but can be valid input
            throw new \Exception('Cannot decode a null or empty string');
        }

        $base = strlen($this->alphabet);
        $strlen = strlen($string);
        $num = 0;
        
        for ($i = 0; $i < $strlen; $i++) {
            if (strpos($this->alphabet, $string[$i]) === false) {
                // TODO: could be a better way to validate this than on every
                // iteration of the string
                throw new \Exception("Invalid encoded string");
            }

            $power = ($strlen - ($i + 1));
            $num += strpos($this->alphabet, $string[$i]) * pow($base, $power);
        }

        return $num;
    }
}