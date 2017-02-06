<?php

namespace Frontend\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomepageController implements Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request)
    {
        return new Response();
    }
}