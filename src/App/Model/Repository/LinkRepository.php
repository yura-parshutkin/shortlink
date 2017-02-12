<?php

namespace App\Model\Repository;

use App\Model\Entity\Link;
use App\ValueObject\Url;

interface LinkRepository
{
    /**
     * @param Link $link
     */
    public function add(Link $link);

    /**
     * @param Url $url
     * @return Link|null
     */
    public function findOneByUrl(Url $url) : ?Link;

    /**
     * @param string $url
     * @return Link|null
     */
    public function findOneByShortId(string $url) : ?Link;
}