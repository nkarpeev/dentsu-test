<?php

namespace App\Controller;

use App\Entity\Process;
use App\Message\Processing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

class ProcessingController extends AbstractController
{
    /**
     * @param Request $request
     * @param MessageBusInterface $bus
     * @return JsonResponse
     */
    public function run(Request $request, MessageBusInterface $bus): JsonResponse
    {
        $msg = new Processing($request->getContent());
        $bus->dispatch($msg);
        return $this->json(['processID' => $msg->getId()]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function status(Request $request): JsonResponse
    {
        $msg = $this->getDoctrine()
            ->getRepository(Process::class)
            ->findOneBy(['number' => $request->get('id')]);

        if (!$msg) {
            $result = [
                'status' => 404,
                'comment' => 'process not found',
            ];
            return $this->json($result);
        }

        $result = [
            'status' => $msg->getStatus(),
            'comment' => $msg->getStatus() ? 'processing is finished' : 'processing',
        ];
        return $this->json($result);
    }

}