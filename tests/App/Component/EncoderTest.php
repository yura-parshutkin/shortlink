<?php

use PHPUnit\Framework\TestCase;
use App\Component\Encoder;

class EncoderTest extends TestCase
{
    public function testHexEncode()
    {
        $id     = 10564321;
        $chars  = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
        $result = (new Encoder($chars))->encode($id);

        $this->assertEquals('A132E1', $result);
    }
}