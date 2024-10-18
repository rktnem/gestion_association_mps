<?php 

namespace App\Form;

use DateTimeImmutable;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Event\PostSubmitEvent;

class FormListenerFactory {

    public function capitalizeString(): callable {
        return function (PostSubmitEvent $event) {
            $data = $event->getData();

            /**
             *  We put all caracter to lowercase and it's after 
             *  we capitalize each words
             */
            $data->setName(ucwords(strtolower($data->getName())));
            $data->setFirstname(ucwords(strtolower($data->getFirstname())));
        };
    }

    public function attachTimestamps(): callable {
        return function (PostSubmitEvent $event) {
            $data = $event->getData();
            
            $data->setUpdatedAt(new DateTimeImmutable());

            if(!$data->getId()) {
                $data->setCreatedAt(new DateTimeImmutable());
            }
        };
    }
}

?>