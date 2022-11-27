<?php

namespace App\Service;

use DateTime;
use App\Entity\Contact;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Validator\Constraints\Date;

class ContactService 

{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    
    {
        $this->manager = $manager;
    }


    public function persistContact(Contact $contact):void


    {
        $contact->setIsSend(false)
                ->setDate(new DateTimeImmutable('now'))
                ->setCreatedAt(new DateTimeImmutable('now'));

        $this->manager->persist($contact);
        $this->manager->flush();
    }

    public function isSend(Contact $contact): void
    {
        $contact->setIsSend(true);

        $this->manager->persist($contact);
        $this->manager->flush();
    }

}
