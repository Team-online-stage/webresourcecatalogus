<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Slug;
use App\Entity\Template;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig_Environment as Environment;

//use App\Service\MailService;
//use App\Service\MessageService;

class TemplateSlugSubscriber implements EventSubscriberInterface
{
    private $params;
    private $em;
    private $templating;

    public function __construct(ParameterBagInterface $params, EntityManagerInterface $em, Environment $twig)
    {
        $this->params = $params;
        $this->em = $em;
        $this->templating = $twig;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['template', EventPriorities::PRE_WRITE],
        ];
    }

    public function template(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        $route = $event->getRequest()->attributes->get('_route');

        if (!$result instanceof Template || $route != 'api_templates_post_collection' || $method != 'POST' || !$result->getApplication()) {
            return;
        }

        $slug = new Slug();
        $slug->setName($result->getName());
        $slug->setTemplate($result);
        $slug->setSlug(urlencode(str_replace(' ', '-', $result->getName())));
        $slug->setApplication($result->getApplication());

        $result->addSlug($slug);

        return $result;
    }
}
