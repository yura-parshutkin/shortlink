<?php

namespace App\Model\Entity;

use App\ValueObject\Url;

class Link implements \JsonSerializable
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Url
     */
    protected $url;

    /**
     * @var string
     */
    protected $shortId;

    /**
     * @param int $id
     * @param Url $url
     * @param string $shortId
     */
    public function __construct(int $id, Url $url, string $shortId)
    {
        $this->id      = $id;
        $this->url     = $url;
        $this->shortId = $shortId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getShortId(): string
    {
        return $this->shortId;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'       => $this->getId(),
            'short_id' => $this->getShortId(),
            'url'      => (string)$this->getUrl()
        ];
    }
}