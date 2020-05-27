<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Template;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig_Environment as Environment;

//use App\Service\MailService;
//use App\Service\MessageService;

class TemplateSubscriber implements EventSubscriberInterface
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
            KernelEvents::VIEW => ['template', EventPriorities::PRE_SERIALIZE],
        ];
    }

    public function template(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        $route = $event->getRequest()->attributes->get('_route');

        if (!$result instanceof Template || $route != 'api_templates_render_template_item' || $method != 'POST') {
            return;
        }

        $request = new Request();

        /*@todo onderstaande verhaal moet uiteraard wel worden gedocumenteerd in redoc */
        $query = $request->query->all();
        $body = json_decode($request->getContent(), true); /*@todo hier zouden we eigenlijk ook xml moeten ondersteunen */

        $variables = array_merge($query, $body);

        switch ($result->getTemplateEngine()) {
            case 'twig':

                $template = $this->templating->createTemplate($result->getContent());
                $reponce = $template->render($variables);
                $result->setContent($reponce);

                break;
            case 'md':
                $reponce = $result->getContent();
                $result->setContent($reponce);
                break;
        }

        return $result;
    }
}
