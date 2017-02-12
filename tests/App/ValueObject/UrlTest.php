<?php

use PHPUnit\Framework\TestCase;
use App\ValueObject\Url;

class UrlTest extends TestCase
{
    public function testNormalize()
    {
        $url    = 'https://ya.ru';
        $result = Url::fromString($url);

        $this->assertEquals($url, (string)$result, 'Expected the same value');
    }

    public function testWithoutProtocol()
    {
        $url    = 'ya.ru';
        $result = Url::fromString($url);

        $this->assertEquals('http://ya.ru', (string)$result, 'Expected url with default protocol');
    }

    public function testWithNotValidUrl()
    {
        $this->expectException(InvalidArgumentException::class);

        Url::fromString('this is not valid url');
    }

    public function testWithEmptyUrl()
    {
        $this->expectException(InvalidArgumentException::class);

        Url::fromString('');
    }

    public function testWithSlashes()
    {
        $url = 'http://ya.ru/';

        $result = Url::fromString($url);

        $this->assertEquals('http://ya.ru', (string)$result);
    }
}