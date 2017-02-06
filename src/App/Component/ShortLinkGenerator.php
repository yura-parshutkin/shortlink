<?php

namespace App\Component;

use App\Component\Url\UrlNormaliser;
use App\Component\Url\UrlValidator;
use App\Model\Link;
use App\Model\LinkRepository;

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
     * @var UrlNormaliser
     */
    protected $urlNormalizer;

    /**
     * @var UrlValidator
     */
    protected $urlValidator;

    /**
     * @var
     */
    protected $sequenceGenerator;

    /**
     * @param LinkRepository $linkRepository
     * @param Encoder $shortLinkEncoder
     * @param UrlNormaliser $urlNormalizer
     * @param UrlValidator $urlValidator
     * @param $sequenceGenerator
     */
    public function __construct(LinkRepository $linkRepository, Encoder $shortLinkEncoder, UrlNormaliser $urlNormalizer, UrlValidator $urlValidator, $sequenceGenerator)
    {
        $this->linkRepository    = $linkRepository;
        $this->shortLinkEncoder  = $shortLinkEncoder;
        $this->urlNormalizer     = $urlNormalizer;
        $this->urlValidator      = $urlValidator;
        $this->sequenceGenerator = $sequenceGenerator;
    }


    /**
     * @param $fullLink
     * @return Link
     */
    public function generate($fullLink)
    {
        $url  = $this->urlNormalizer->normalize($fullLink);

        $this->urlValidator->validate($url);

        if ($link = $this->linkRepository->findByFullLink($url)) {
            return $link;
        }

        $id        = '';
        $shortLink = $this->shortLinkEncoder->encode($id, $url);
        $link      = new Link($id, $fullLink, $shortLink);

        $this->linkRepository->add($link);

        return $link;
    }
}