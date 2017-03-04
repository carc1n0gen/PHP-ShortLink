<?php

use PHPUnit\Framework\TestCase;
use Carc1n0gen\ShortLink\Converter;
use Carc1n0gen\ShortLink\Errors\DecodingException;

final class ConverterTest extends TestCase
{
    public function testZeroInput()
    {
        $alphabet = 'abc123';
        $converter = new Converter($alphabet);
        $this->assertEquals($alphabet[0], $converter->encode(0));
    }

    public function testDecodedMatchesOriginal()
    {
        $converter = new Converter();
        $num = 5;

        $encoded = $converter->encode($num);
        $this->assertEquals($num, $converter->decode($encoded));
    }

    public function testDecodedMatchesOriginalWithCustomAlphabet()
    {
        $converter = new Converter('abc123');
        $num = 10;

        $encoded = $converter->encode($num);
        $this->assertEquals($num, $converter->decode($encoded));
    }

    public function testCannotEncodeString()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new Converter();
        $converter->encode('hello');
    }

    public function testCannotEncodeNegativeInt()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new Converter();
        $converter->encode(-1);
    }

    public function testCannotDecodeFromOutsideAlphabet()
    {
        $this->setExpectedException(DecodingException::class);

        $converter = new Converter('abc123');
        $converter->decode('xyz456');
    }

    public function testCannotDecodeNull()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new Converter();
        $converter->decode(null);
    }

    public function testCannotDecodeEmptystring()
    {
        $this->setExpectedException(\Exception::class);

        $converter = new Converter();
        $converter->decode('');
    }
    
    public function testCannotUseSingleCharacterAlphabet()
    {
        $this->setExpectedException(\Exception::class);
        
        $converter = new Converter('1');
        $converter->encode(1);
    }
}
