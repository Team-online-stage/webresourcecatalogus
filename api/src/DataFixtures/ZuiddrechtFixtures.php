<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Organization;
use App\Entity\Slug;
use App\Entity\Style;
use App\Entity\Template;
use App\Entity\TemplateGroup;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ZuiddrechtFixtures extends Fixture
{
    private $params;
    /**
     * @var CommonGroundService
     */
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Zuid-Drecht
        $id = Uuid::fromString('4d1eded3-fbdf-438f-9536-8747dd8ab591');
        $organization = new Organization();
        $organization->setName('Zuid Drecht');
        $organization->setDescription('De meest inovatieve gemeenten van nederland');
        $organization->setRsin('1234');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('Zuid-Drecht Favicon');
        $favicon->setDescription('Zuid-Drecht VNG');
        $favicon->setOrganization($organization);

        $logo = new Image();
        $logo->setName('Zuid-Drecht Logo');
        $logo->setDescription('Zuid-Drecht VNG');
        $logo->setOrganization($organization);

        $style = new Style();
        $style->setName('Zuid-Drecht');
        $style->setDescription('Huistlijl samenwerkingsverband West-Friesland');
        $style->setCss(':root {--primary: #CC0000;--primary2: white;--secondary: #3669A5;--secondary2: #FFC926;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->setOrganization($organization);

        $manager->persist($organization);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();


        // Website
        $id = Uuid::fromString('1163e443-5f9c-4aa6-802c-c619a14986c9');
        $application = new Application();
        $application->setName('Dashboard');
        $application->setDescription('het Dashboard van de gemeente zuid-drecht');
        $application->setDomain('db.zuid-drecht.nl');
        $application->setOrganization($organization);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Website
        $id = Uuid::fromString('1ef30b69-6b28-4fbd-a0cd-83d6ff3c505e');
        $application = new Application();
        $application->setName('Website');
        $application->setDescription('De website van de gemeente zuid-drecht');
        $application->setDomain('zuid-drecht.nl');
        $application->setOrganization($organization);
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('Website');
        $configuration->setDescription('De website van de gemeente zuid-drecht');
        $configuration->setOrganization($organization);
        $configuration->setApplication($application);
        $configuration->setConfiguration(
            [
                'mainMenu'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/menus/ca1ca0b4-4c8f-4638-9869-16974426e3df"),
                'home'    => $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/templates/163f8616-abb7-411d-b7b2-0d11c6bd7dca"),
                'footer1'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/templates/0dca3fd2-0124-46fb-88c1-4f0860b2888c"),
                'footer2'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/templates/68003cd6-7729-4807-af24-d58a1dfe0870"),
                'footer3'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/templates/facad633-27a9-499a-b3fc-4687215bf82a"),
                'footer4'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/templates/4bc966b6-e310-4bce-b459-a7cf65651ce0"),]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('ca1ca0b4-4c8f-4638-9869-16974426e3df');
        $menu = new Menu();
        $menu->setName('Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Processen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Verzoeken');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/requests');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Nieuws');
        $menuItem->setDescription('Nieuws overzicht');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/nieuws');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Ondernemers');
        $menuItem->setDescription('Lijst van ondernemers');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/ondernemers');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organization);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('163f8616-abb7-411d-b7b2-0d11c6bd7dca');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('De (web) applicatie waarop begravenisen kunnen worden doorgegeven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $id = Uuid::fromString('fc5cef2d-c64d-4cfc-ac8c-da0ea0c66063');
        $template = new Template();
        $template->setName('SubPage');
        $template->setDescription('tijdelijke subpage');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/subpage.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('subpage');
        $slug->setSlug('subpage');
        $manager->persist($slug);

        $id = Uuid::fromString('0dca3fd2-0124-46fb-88c1-4f0860b2888c');
        $template = new Template();
        $template->setName('footer1');
        $template->setDescription('footer1');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('68003cd6-7729-4807-af24-d58a1dfe0870');
        $template = new Template();
        $template->setName('footer2');
        $template->setDescription('footer2');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('facad633-27a9-499a-b3fc-4687215bf82a');
        $template = new Template();
        $template->setName('footer3');
        $template->setDescription('footer3');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('4bc966b6-e310-4bce-b459-a7cf65651ce0');
        $template = new Template();
        $template->setName('footer4');
        $template->setDescription('footer4');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();



        // Mijn Zuid Decht
        $id = Uuid::fromString('64f60afd-7506-48e0-928b-6bbede045812');
        $application = new Application();
        $application->setName('Mijn Zuidrecht');
        $application->setDescription('Het burgerportaal van de gemeente zuiddrecht');
        $application->setDomain('mijn.zuid-drecht.nl');
        $application->setOrganization($organization);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setOrganization($organization);
        $configuration->setApplication($application);
        $configuration->setConfiguration(
            [
                'mainMenu'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/menus/350156d4-4eca-4bec-bc48-c906f20d2bda"),
                'home'    => $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/templates/f62792c9-d229-43b9-8f6a-3b368eee6739"),
                ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('350156d4-4eca-4bec-bc48-c906f20d2bda');
        $menu = new Menu();
        $menu->setName('Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Processen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Verzoeken');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/requests');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organization);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('f62792c9-d229-43b9-8f6a-3b368eee6739');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('De (web) applicatie waarop begravenisen kunnen worden doorgegeven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/mijnzuiddrecht/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();
    }
}
