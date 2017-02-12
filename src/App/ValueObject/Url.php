<?php

namespace App\ValueObject;

class Url
{
    /**
     * @var string
     */
    private $url;

    const DEFAULT_PROTOCOL = 'http';

    /**
     * @param string $url
     */
    private function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param string $url
     * @throws \InvalidArgumentException
     * @return Url
     */
    static public function fromString(string $url) :Url
    {
        $url = rtrim($url, '/');

        if (empty($url)) {
            throw new \InvalidArgumentException('This url is empty');
        }

        if (empty(parse_url($url, PHP_URL_SCHEME))) {
            $url = self::DEFAULT_PROTOCOL . '://' . $url;
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('This url is not valid');
        }

        return new self($url);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }
}