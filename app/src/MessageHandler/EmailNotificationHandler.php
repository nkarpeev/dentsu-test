<?php

namespace App\MessageHandler;

use App\Message\EmailNotification;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

class EmailNotificationHandler implements MessageHandlerInterface
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(EmailNotification $msg)
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($msg->getContent())
            ->subject('processing info')
            ->html('<p>processing is finished</p>');

        $this->mailer->send($email);
    }
}