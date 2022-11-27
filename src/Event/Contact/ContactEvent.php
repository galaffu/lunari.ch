<?php

namespace App\Event\Contact;

use App\Entity\Contact;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\Validator\Constraints\File;

class ContactEvent extends Event
{

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function getContactData() : Contact
    {
        return $this->contact;
    }

}
