<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class AbstractController extends AbstractFOSRestController
{
    protected function createView($content = null, int $status = Response::HTTP_NO_CONTENT, array $headers = []): View
    {
        return $this->view($content, $status, $headers);
    }
}
