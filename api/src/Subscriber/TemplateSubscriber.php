<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Template;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
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
        $contentType = $event->getRequest()->headers->get('accept');
        if (!$contentType) {
            $contentType = $event->getRequest()->headers->get('Accept');
        }

        if (!$result instanceof Template || $route != 'api_templates_render_template_item' || $method != 'POST') {
            return;
        }

        $request = new Request();

        /*@todo onderstaande verhaal moet uiteraard wel worden gedocumenteerd in redoc */
        $query = $request->query->all();
        $body = json_decode($request->getContent(), true); /*@todo hier zouden we eigenlijk ook xml moeten ondersteunen */

        $variables = array_merge($query, $result->getVariables());

        switch ($result->getTemplateEngine()) {
            case 'twig':

                $template = $this->templating->createTemplate($result->getContent());
                $response = $template->render($variables);
                $result->setContent($response);

                break;
            case 'md':
                $response = $result->getContent();
                $result->setContent($response);
                break;
        }
        $stamp = microtime();
        switch ($contentType) {
            case 'application/ld+json':
            case 'application/json':
            case 'application/hal+json':
            case 'application/xml':
                return $result;
            case 'application/vnd.ms-word':
            case 'vnd.openxmlformats-officedocument.wordprocessing':

                $phpWord = new PhpWord();
                $section = $phpWord->addSection();
                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $response);
                $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
                $filename = dirname(__FILE__, 3)."/var/{$template->getTemplateName()}_$stamp.docx";
                $objWriter->save($filename);
                header('Content-Type: application/vnd.ms-word');
                header("Content-Disposition: attachment; filename={$template->getTemplateName()}_$stamp.docx.docx");
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                flush();
                readfile($filename);
                unlink($filename); // deletes the temporary file
                exit;
            case 'application/pdf':
                $phpWord = new PhpWord();
                $section = $phpWord->addSection();
                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $response);
                $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
                $filenameDocx = dirname(__FILE__, 3)."/var/{$template->getTemplateName()}_$stamp.docx";
                $objWriter->save($filenameDocx);
                $phpWord = \PhpOffice\PhpWord\IOFactory::load($filenameDocx);
                $rendererName = Settings::PDF_RENDERER_DOMPDF;
                $rendererLibraryPath = realpath('../vendor/dompdf/dompdf');
                Settings::setPdfRenderer($rendererName, $rendererLibraryPath);
                $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
                $filename = dirname(__FILE__, 3)."/var/{$template->getTemplateName()}_$stamp.pdf";
                $xmlWriter->save($filename);
                header("Content-Disposition: attachment; filename={$template->getTemplateName()}_$stamp.pdf");
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                flush();
                readfile($filename);
                unlink($filename); // deletes the temporary file
                unlink($filenameDocx); // deletes the temporary file
                exit;
        }

        return $result;
    }
}
