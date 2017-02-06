<?php

namespace Frontend\Controller;

use App\Component\ShortLinkGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateLinkApiController
{
    /**
     * @var ShortLinkGenerator
     */
    protected $shortLinkGenerator;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request)
    {
        $link = $this->shortLinkGenerator->generate(
            $request->request->get('url')
        );

        return new JsonResponse($link);
    }
}