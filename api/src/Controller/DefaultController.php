<?php

// api/src/Controller/BookController.php

namespace App\Controller;

use App\Entity\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function __invoke(Template $data): Template
    {
        //$this->bookPublishingHandler->handle($data);

        return $data;
    }
}
