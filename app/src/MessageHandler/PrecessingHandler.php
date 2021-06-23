<?php

namespace App\MessageHandler;

use App\Entity\Process;
use App\Message\EmailNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Message\Processing;
use Symfony\Component\Messenger\MessageBusInterface;

class PrecessingHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;
    private MessageBusInterface $bus;

    public function __construct(EntityManagerInterface $em, MessageBusInterface $bus)
    {
        $this->em = $em;
        $this->bus = $bus;
    }

    public function __invoke(Processing $msg)
    {
        $process = new Process();
        $process->setNumber($msg->getId());
        $process->setStatus(Process::IN_PROCESS);

        $this->em->persist($process);
        $this->em->flush();

        sleep(5);

        /** @vat $process Process */
        $process->setStatus(Process::FINISHED);

        $this->em->persist($process);
        $this->em->flush();

        if($msg->getEmail()) {
            $email = new EmailNotification($msg->getEmail());
            $this->bus->dispatch($email);
        }
    }
}