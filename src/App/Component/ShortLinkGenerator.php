<?php

namespace App\Component;

use App\Component\Postgres\SequenceGenerator;
use App\Model\Entity\Link;
use App\Model\Repository\LinkRepository;
use App\ValueObject\Url;

class ShortLinkGenerator
{
    /**
     * @var LinkRepository
     */
    protected $linkRepository;

    /**
     * @var Encoder
     */
    protected $shortLinkEncoder;

    /**
     * @var SequenceGenerator
     */
    protected $sequenceGenerator;

    const LINKS_TABLE_NAME = 'links';

    /**
     * @param LinkRepository $linkRepository
     * @param Encoder $shortLinkEncoder
     * @param $sequenceGenerator
     */
    public function __construct(LinkRepository $linkRepository, Encoder $shortLinkEncoder, SequenceGenerator $sequenceGenerator)
    {
        $this->linkRepository    = $linkRepository;
        $this->shortLinkEncoder  = $shortLinkEncoder;
        $this->sequenceGenerator = $sequenceGenerator;
    }


    /**
     * @param Url $url
     * @return Link
     */
    public function generate(Url $url)
    {
        if ($link = $this->linkRepository->findOneByUrl($url)) {
            return $link;
        }

        $id      = $this->sequenceGenerator->generate(self::LINKS_TABLE_NAME);
        $shortId = $this->shortLinkEncoder->encode($id);
        $link    = new Link($id, $url, $shortId);

        $this->linkRepository->add($link);

        return $link;
    }
}