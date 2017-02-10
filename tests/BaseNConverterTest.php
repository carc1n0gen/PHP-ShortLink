<?php

use PHPUnit\Framework\TestCase;
use Carc1n0gen\BaseN\BaseNConverter;

final class BaseNConverterTest extends TestCase
{
    public function testZeroInput()
    {
        $alphabet = 'abc123';
        $converter = new BaseNConverter($alphabet);
        $this->assertEquals($alphabet[0], $converter->encode(0));
    }

    public function testDecodedMatchesOriginal()
    {
        $converter = new BaseNConverter();
        $num = 5;

        $encoded = $converter->encode($num);
        $this->assertEquals($num, $converter->decode($encoded));
    }

    public function testDecodedMatchesOriginalWithCustomAlphabet()
    {
        $converter = new BaseNConverter('abc123');
        $num = 10;

        $encoded = $converter->encode($num);
        $this->assertEquals($num, $converter->decode($encoded));
    }

    public function testDecodedMatchesOriginalWithRandomization()
    {
        $converter = new BaseNConverter(null, true);
        $num = 24;

        $encoded = $converter->encode($num);
        $this->assertEquals($num, $converter->decode($encoded));
    }

    public function testDecodedMatchesOriginalWithCustomAlphabetAndRandomization()
    {
        $converter = new BaseNConverter('abc123', true);
        $num = 144;

        $encoded = $converter->encode($num);
        $this->assertEquals($num, $converter->decode($encoded));
    }

    public function testCannotEncodeString()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new BaseNConverter();
        $converter->encode('hello');
    }

    public function testCannotEncodeNegativeInt()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new BaseNConverter();
        $converter->encode(-1);
    }

    public function testCannotDecodeFromOutsideAlphabet()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new BaseNConverter('abc123');
        $converter->decode('xyz456');
    }

    public function testCannotDecodeNull()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new BaseNConverter();
        $converter->decode(null);
    }

    public function testCannotDecodeEmptystring()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new BaseNConverter();
        $converter->decode('');
    }
    
    public function testCannotUseSingleCharacterAlphabet()
    {
        $this->setExpectedException(\Exception::class);
        
        $converter = new BaseNConverter('1');
        $converter->encode(1);
    }
}
