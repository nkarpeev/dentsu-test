<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProcessingController extends AbstractController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function run(Request $request) {
        return $this->json('OK');
    }

    public function status(Request $request) {
        return $this->json($request->get('guid'));
    }

}