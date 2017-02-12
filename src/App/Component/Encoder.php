<?php

namespace App\Component;

class Encoder
{
    /**
     * @var array
     */
    protected $chars;

    /**
     * @param array $chars
     */
    public function __construct(array $chars)
    {
        $this->chars = $chars;
    }

    /**
     * @param int $id
     * @return string
     */
    public function encode(int $id) :string
    {
        $length = count($this->chars);
        $char   = '';

        while ($id > $length) {
            $diff = $id % $length;
            $char = $this->chars[$diff] . $char;
            $id   = ($id - $diff) / $length;
        }

        return $this->chars[$id] . $char;
    }
}