<?php

namespace App\Service;

use App\Entity\Don;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailService
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendDonConfirmation(Don $don)
    {
        $email = (new Email())
            ->from('tourathapp@gmail.com')
            ->to('chiheb.menjli@esprit.tn')
            ->subject('don ajouer')
           /* ->html($this->twig->render('admin/don', [
                'don' => $don
            ]));*/
           ->text('Une nouvelle donation a été ajoutée.');

        $this->mailer->send($email);
    }
}
