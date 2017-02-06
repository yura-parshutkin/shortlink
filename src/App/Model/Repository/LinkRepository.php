<?php

namespace App\Model;

interface LinkRepository
{
    /**
     * @param Link $link
     */
    public function add(Link $link);

    /**
     * @param $fullLink
     * @return Link
     */
    public function findByFullLink($fullLink);

    /**
     * @param $shortLink
     * @return Link
     */
    public function findByShortLink($shortLink);
}