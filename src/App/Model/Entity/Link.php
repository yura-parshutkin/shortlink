<?php

namespace App\Model;

class Link
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $fullLink;

    /**
     * @var string
     */
    protected $shortLink;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @param int $id
     * @param string $fullLink
     * @param string $shortLink
     */
    public function __construct($id, $fullLink, $shortLink)
    {
        $this->id        = $id;
        $this->fullLink  = $fullLink;
        $this->shortLink = $shortLink;
    }
}