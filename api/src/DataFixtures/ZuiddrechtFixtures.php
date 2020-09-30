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

    public const ORGANIZATION_ZUIDDRECHT = 'organization-zuiddrecht';

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
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
        $organization->setRsin('809642451');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $this->addReference(self::ORGANIZATION_ZUIDDRECHT, $organization);

        $favicon = new Image();
        $favicon->setName('Zuid-Drecht Favicon');
        $favicon->setBase64('data:image/svg+xml;base64,PHN2ZyBpZD0iw5HDq8Ouw6lfMSIgZGF0YS1uYW1lPSLDkcOrw67DqSAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MzkuNTcgMTA5OC44OSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMDA7fS5jbHMtMntmaWxsOiMzNjY5YTU7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT56dWlkIERyZWNodCBOb3BheW9mZjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTc2LDk2Ny4xMWMtNTYsNDEuMzktMTAxLjQzLDY2LjA1LTExMSw3MS4xMWE0LDQsMCwwLDEtMy43MiwwYy0yNS41Ny0xMy41LTMwNy40OC0xNjctMzYxLjM3LTQwNmE0LDQsMCwwLDEsNy4zOC0yLjgxYzM4LjU0LDY4LjkzLDEyNS4zNywxMTkuMjYsMTg3LjUxLDE1Mi42OSw1Mi41LDI4LjIzLDExMy42Miw1MC4yMSwxNjguMzQsODAuMzZDNTA4LjIyLDg4Ny4yOSw1NDksOTE3LjY5LDU3Nyw5NjEuNzVBNCw0LDAsMCwxLDU3Niw5NjcuMTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNODM0LjcxLDIxNS44NFYxMDEuNjVhOC45LDguOSwwLDAsMC04LjktOC45MWgtMjczQTE0LjU5LDE0LjU5LDAsMCwwLDUzOS40MywxMDNsLTE5LDcwLjI4YTE0LjU4LDE0LjU4LDAsMCwxLTEzLjM1LDEwLjIxSDM4M1YxNDcuMTJjMzYuODQtMS4zNCw2Mi40Mi03LjQ1LDgwLjE2LTE1LjEsMjkuNDktMTIuNzQsMzcuMzUtMjkuNzgsMzkuMzYtMzYuNDRhMi4yMiwyLjIyLDAsMCwwLTIuMTMtMi44NEgzMzQuNjFjLTMzLjg4LDAtNjcuOTEsOS4yLTg2LjA4LDQwLjEtMTkuMzgsMzIuOTQtMTguMjQsNzguMDctMTYuNDksMTE0Ljg5LDAsMC01MC02Ni4yMi00MC43Ni0xNDguODdhNS41MSw1LjUxLDAsMCwwLTUuNDgtNi4xMkgxMDAuMzJhOC43OSw4Ljc5LDAsMCwwLTguNzgsOC43OVYxMjRjNC44Niw3OS4yNiw0OS4xNCwyODguNTcsMzcxLjU4LDM4NS40QzczNSw1OTEuMDYsNzc1LjQyLDcxNi4zLDc4My4zMiw3MzguMjRhMS4zOCwxLjM4LDAsMCwwLDIuNTMuMTdjNzUuMy0xNDMuOS04MS40OS0yNDcuNTItODEuNDktMjQ3LjUyLDMxLjMzLDAsNzkuMjMsMTcuOTQsMTE4LDM5Ljc5YTguMjgsOC4yOCwwLDAsMCwxMi4zNy03LjIxVjM2My44M2ExNC42LDE0LjYsMCwwLDAtMTguMTUtMTQuMTdjLTEzLjUsMy4zOS0zMCw2LjY4LTMyLjg3LDcuMjMtMzkuNDYsNy43Ny04NC43NSwxMS4xNS0xMjItOC43M3MtNDcuMjYtNjYuMjctMTguMzMtOTguMjNjMjUuMy0yOCw2NS41My0zNy41LDEwMi4yOS0zNSwyMy41NiwxLjYyLDU1LjE4LDcuNTksNzMuNzEsMTIuNjNBMTIuMTYsMTIuMTYsMCwwLDAsODM0LjcxLDIxNS44NFoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik02NTQuODcsOTAxLjVhNCw0LDAsMCwxLTYtLjExYy0xMy41Ni0xNi4yNS03NS40Ni04Ni0xODUuNzMtMTQ2LjQyQTc1Ni40NCw3NTYuNDQsMCwwLDAsMzgzLDcxN2MtMTczLjUzLTcwLjE3LTI4Mi42OS0xNDMuMy0yOTEuNDItMzM4LjF2LTYuMjJhNCw0LDAsMCwxLDcuMjEtMi4zNGM2My42MSw4NywxNDQuNjksMTM3LjksMjQzLjE2LDE4Ni43Nyw0MC4yOCwyMCw4MS4xNywzNi4zMiwxMjEuMjEsNTMuMjUsNjYuMTUsMjgsMTMwLDU3LjU0LDE4NC43MywxMDcuOCwxNi4xOCwxNC44NSwyOS4wOSwyOS4xNSwzNi44MSw1MEM2OTUuNzUsNzk4LjEzLDcwMi41NSw4NDkuMTcsNjU0Ljg3LDkwMS41WiIvPjwvc3ZnPg==');
        $favicon->setDescription('Zuid-Drecht VNG');
        $favicon->setOrganization($organization);

        $id = Uuid::fromString('0e5b1531-4abb-4704-9bd3-feeb94717521');
        $newsimg = new Image();
        $newsimg->setName('news image');
        $newsimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/afbeeldingen/zuiddrecht_news.jpg', 'r')));
        $newsimg->setDescription('Zuid-Drecht news');
        $newsimg->setOrganization($organization);
        $manager->persist($newsimg);
        $newsimg->setId($id);
        $manager->persist($newsimg);
        $manager->flush();
        $newsimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('ff3ca823-234f-4874-9ee6-1067d47e4391');
        $headerimg = new Image();
        $headerimg->setName('header image');
        $headerimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/afbeeldingen/zuiddrecht_header.jpg', 'r')));
        $headerimg->setDescription('Zuid-Drecht header');
        $headerimg->setOrganization($organization);
        $manager->persist($headerimg);
        $headerimg->setId($id);
        $manager->persist($headerimg);
        $manager->flush();
        $headerimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Zuid-Drecht Logo');
        $logo->setDescription('Zuid-Drecht VNG');
        $logo->setOrganization($organization);

        $style = new Style();
        $style->setName('Zuid-Drecht');
        $style->setDescription('Huistlijl Gemeente Zuid-Drecht');
        $style->setCss('
        :root {
                --primary: #CC0000;
                --primary-color: white;
                --secondary: #3669A5;
                --secondary-color: white;

                --menu: #CC0000;
                --menu-over: #3669A5;
                --menu-color: white;
                --footer: #3669A5;
                --footer-color: white;
         }');

        $style->setfavicon($favicon);
        $style->addOrganization($organization);

        $manager->persist($organization);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        $styleDashboard = new Style();
        $styleDashboard->setName('dashboard');
        $styleDashboard->setDescription('Huistlijl Gemeente Zuid-Drecht');
        $styleDashboard->setCss(':root {--primary: #CC0000;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');
        $styleDashboard->setfavicon($favicon);
        $styleDashboard->addOrganization($organization);
        $manager->persist($styleDashboard);

        $manager->flush();

        // Configuratie dashboard
        $configuration = new Configuration();
        $configuration->setName('Dashboard');
        $configuration->setDescription('Dashboard van Zuid-Drecht');
        $configuration->setOrganization($organization);
        $configuration->setConfiguration(
            [
                'sideMenu'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'915d5b04-c050-4b18-8f72-a068c2708883']),
                'userPage'          => '/dashboard/ud/applications',
            ]
        );
        $manager->persist($configuration);

        // Dashboard
        $id = Uuid::fromString('1163e443-5f9c-4aa6-802c-c619a14986c9');
        $application = new Application();
        $application->setName('Dashboard');
        $application->setDescription('het Dashboard van de gemeente Zuid-Drecht');
        $application->setDomain('db.zuid-drecht.nl');
        $application->setOrganization($organization);
        $application->setDefaultConfiguration($configuration);
        $application->setStyle($styleDashboard);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('Website');
        $configuration->setDescription('De website van de gemeente Zuid-Drecht');
        $configuration->setOrganization($organization);
        $configuration->setConfiguration(
            [
                'mainMenu'                  => 'ca1ca0b4-4c8f-4638-9869-16974426e3df',
                'home'                      => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'163f8616-abb7-411d-b7b2-0d11c6bd7dca']),
                'footer1'                   => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'0dca3fd2-0124-46fb-88c1-4f0860b2888c']),
                'footer2'                   => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'68003cd6-7729-4807-af24-d58a1dfe0870']),
                'footer3'                   => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'facad633-27a9-499a-b3fc-4687215bf82a']),
                'footer4'                   => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'4bc966b6-e310-4bce-b459-a7cf65651ce0']),
                'news'                      => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'5c59f238-1ce3-4c8d-8107-4bd8e2134648']),
                'about'                     => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'6b243aa1-5ae6-4aeb-93d5-2f509fb34cef']),
                'newsimg'                   => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'0e5b1531-4abb-4704-9bd3-feeb94717521']),
                'headerimg'                 => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'ff3ca823-234f-4874-9ee6-1067d47e4391']),
                'changeRequest'             => '7216b69d-e245-488e-af8f-0969241926e7',
                'objectionRequest'          => '2a95ba3e-a3f9-4fdf-8a6d-005d96aad405',
                'nameChangeRequest'         => '2a95ba3e-a3f9-4fdf-8a6d-005d96aad405',
                'familyChangeRequest'       => '2a95ba3e-a3f9-4fdf-8a6d-005d96aad405',
                'genderRequest'             => '2a95ba3e-a3f9-4fdf-8a6d-005d96aad405',
                'moveRequest'               => '2a95ba3e-a3f9-4fdf-8a6d-005d96aad405',
                'orderTemplate'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'d52644b8-d0af-4102-976c-8737802e0b7c']),
                'invoiceTemplate'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'d273afad-4a3d-426d-a621-55720cac5d4e']),
                'login'                     => ['digid'=>true, 'eherkening'=>true], //,'employee'
                'hubspotId'                 => '6108438',
                'googleTagId'               => 'G-RHY411XSJN',
                'newsGroup'                 => ['1'],
                'userPage'                  => 'persoonlijk',
                'header'                    => true,
                'search'                    => true,
            ]
        );
        $manager->persist($configuration);

        // Website
        $id = Uuid::fromString('1ef30b69-6b28-4fbd-a0cd-83d6ff3c505e');
        $application = new Application();
        $application->setName('Zuid-Drecht');
        $application->setDescription('De website van de gemeente Zuid-Drecht');
        $application->setDomain('zuid-drecht.nl');
        $application->setOrganization($organization);
        $application->setDefaultConfiguration($configuration);
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // loggedIn menu
        $id = Uuid::fromString('364350f5-d2a5-49f3-adab-484c357fa82f');
        $menu = new Menu();
        $menu->setName('loggedIn');
        $menu->setDescription('logged in menu');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Mijn Zuid-Drecht');
        $menuItem->setDescription('Stages');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/request');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Side menu
        $id = Uuid::fromString('915d5b04-c050-4b18-8f72-a068c2708883');
        $menu = new Menu();
        $menu->setName('Side Menu');
        $menu->setDescription('Side menu voor dashboard');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Als test wrc/templates');
        $menuItem->setDescription('test');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('{{ path("app_wrc_templates") }}');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Main Menu
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
        $menuItem->setName('Zelf regelen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/ptc');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        /*
        $menuItem = new MenuItem();
        $menuItem->setName('Ondernemers');
        $menuItem->setDescription('Lijst van ondernemers');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/ondernemers');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Producten en diensten');
        $menuItem->setDescription('Lijst van producten en diensten');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/producten');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);
        */

        $menuItem = new MenuItem();
        $menuItem->setName('Nieuws');
        $menuItem->setDescription('Nieuws overzicht');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/nieuwsoverzicht');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/home');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Template group: documents
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organization);
        $groupPages->setApplication($application);
        $groupPages->setName('Documents');
        $groupPages->setDescription('Document templates');
        $manager->persist($groupPages);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organization);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Persoonlijk
        $template = new Template();
        $template->setName('Persoonlijk');
        $template->setDescription('persoonlijke overzichts pagine');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/persoonlijk.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('persoonlijk');
        $slug->setSlug('persoonlijk');
        $manager->persist($slug);

        // Pages
        $id = Uuid::fromString('163f8616-abb7-411d-b7b2-0d11c6bd7dca');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('Zuid drecht home page');
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

        $id = Uuid::fromString('9a974240-adce-4a47-a3e6-52c2e81e35ea');
        $template = new Template();
        $template->setName('HO Akte Grafrecht');
        $template->setDescription('HO Akte Grafrecht document');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Documents/HO_Akte_Grafrecht.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

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

        $id = Uuid::fromString('e16d97e0-e3ed-4768-88c6-02729660e7b5');
        $template = new Template();
        $template->setName('nieuwsbrief');
        $template->setDescription('nieuwsbrief');
        $template->setTitle('Nieuwsbrief');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/email.html.twig', 'r'));
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
        $slug->setName('nieuwsbrief');
        $slug->setSlug('nieuwsbrief');
        $manager->persist($slug);

        $id = Uuid::fromString('42594401-3db2-42c5-b06a-0b6d5eaeb8c2');
        $template = new Template();
        $template->setName('nieuwsoverzicht');
        $template->setDescription('nieuwsoverzicht');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/nieuwsoverzicht.html.twig', 'r'));
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
        $slug->setName('nieuwsoverzicht');
        $slug->setSlug('nieuwsoverzicht');
        $manager->persist($slug);

        $id = Uuid::fromString('66687380-ec1a-4b87-9ccd-5fa7af5e8c50');
        $template = new Template();
        $template->setName('api');
        $template->setDescription('api');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/api.html.twig', 'r'));
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
        $slug->setName('api');
        $slug->setSlug('api');
        $manager->persist($slug);

        // Template groups
        $id = Uuid::fromString('6b243aa1-5ae6-4aeb-93d5-2f509fb34cef');
        $groupOver = new TemplateGroup();
        $groupOver->setOrganization($organization);
        $groupOver->setApplication($application);
        $groupOver->setName('Over');
        $groupOver->setDescription('Meer informatie over zuid drecht');
        $manager->persist($groupOver);
        $groupOver->setId($id);
        $manager->persist($groupOver);
        $manager->flush();
        $groupOver = $manager->getRepository('App:TemplateGroup')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('b4d411c7-17b3-469b-8a4a-2f334dbaeb4c');
        $template = new Template();
        $template->setName('concept');
        $template->setTitle('Concept');
        $template->setDescription('Er is meer mogelijk met open source en specifiek Common Ground, dan de meeste mensen en gemeenten denken. Om dat te illustreren is de fictieve gemeente Zuid-Drecht in het leven geroepen. ');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/concept.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $template->addTemplateGroup($groupOver);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('concept');
        $slug->setSlug('concept');
        $manager->persist($slug);

        $id = Uuid::fromString('22689f6d-9f62-4025-b880-18d8ba63818f');
        $template = new Template();
        $template->setName('functionaliteit');
        $template->setTitle('Functionaliteit');
        $template->setDescription('De gemeente Zuid-Drecht stapt via een inktvlek model over op Common Ground, daarmee bedoelen dat we één voor één functionaliteiten zullen toevoegen aan deze omgeving.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/functionaliteit.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $template->addTemplateGroup($groupOver);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('functionaliteit');
        $slug->setSlug('functionaliteit');
        $manager->persist($slug);

        $id = Uuid::fromString('5bf63407-73dc-4c9b-a458-3350e9325457');
        $template = new Template();
        $template->setName('roadmap');
        $template->setTitle('Roadmap');
        $template->setDescription('Dit is nog maar het begin van Zuid-Drecht, de volgende dingen staan op onze wishlist om zo snel mogelijk aan Zuid-Drecht toe te voegen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/roadmap.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $template->addTemplateGroup($groupOver);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('roadmap');
        $slug->setSlug('roadmap');
        $manager->persist($slug);

        $id = Uuid::fromString('55a98b6b-8ca7-4c2f-a0a0-2c559efeb189');
        $template = new Template();
        $template->setName('voor-developers');
        $template->setTitle('Voor developers');
        $template->setDescription('De gemeente Zuid-Drecht is niet alleen bedoeld voor beslissers in gemeenten die zicht proberen te krijgen op de mogelijkheden rondom Common Ground, maar is tevens  ook een voorbeeld Common  Ground-ecosysteem.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/voor-developers.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $template->addTemplateGroup($groupOver);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('voor-developers');
        $slug->setSlug('voor-developers');
        $manager->persist($slug);

        $id = Uuid::fromString('9ab2a88c-b8f2-434d-bc63-76402a0166c9');
        $template = new Template();
        $template->setName('contact');
        $template->setDescription('contact');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/contact.html.twig', 'r'));
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
        $slug->setName('contact');
        $slug->setSlug('contact');
        $manager->persist($slug);

        $id = Uuid::fromString('5ecb3603-c245-43f5-85cb-80e4640639f6');
        $template = new Template();
        $template->setName('repositories');
        $template->setDescription('repositories');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/repositories.html.twig', 'r'));
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
        $slug->setName('repositories');
        $slug->setSlug('repositories');
        $manager->persist($slug);

        $id = Uuid::fromString('01cb91e9-7211-45b8-aee9-6f044f3b41dc');
        $template = new Template();
        $template->setName('uitleg');
        $template->setDescription('uitleg');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/uitleg.html.twig', 'r'));
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
        $slug->setName('uitleg');
        $slug->setSlug('uitleg');
        $manager->persist($slug);

        $id = Uuid::fromString('bc227e94-e542-4623-a88b-ca9f74c52bf8');
        $template = new Template();
        $template->setName('cookies');
        $template->setDescription('cookies');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/cookies.html.twig', 'r'));
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
        $slug->setName('cookies');
        $slug->setSlug('cookies');
        $manager->persist($slug);

        $id = Uuid::fromString('bdcd7f74-2407-4ca2-b89a-9fcb33ab6b1f');
        $template = new Template();
        $template->setName('proclaimer');
        $template->setDescription('proclaimer');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/proclaimer.html.twig', 'r'));
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
        $slug->setName('proclaimer');
        $slug->setSlug('proclaimer');
        $manager->persist($slug);

        $id = Uuid::fromString('a8fe7cc7-d358-4081-8597-cd21ae87c295');
        $template = new Template();
        $template->setName('article');
        $template->setDescription('article');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/article.html.twig', 'r'));
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
        $slug->setName('article');
        $slug->setSlug('article');
        $manager->persist($slug);

        $id = Uuid::fromString('9c8095f4-4252-4c49-b4d2-caa6515d8a69');
        $template = new Template();
        $template->setName('producten');
        $template->setDescription('producten');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/producten.html.twig', 'r'));
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
        $slug->setName('producten');
        $slug->setSlug('producten');
        $manager->persist($slug);

        $id = Uuid::fromString('4a080e26-2deb-4fdd-ab4d-38d50c64261d');
        $template = new Template();
        $template->setName('product');
        $template->setDescription('product');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/product.html.twig', 'r'));
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
        $slug->setName('product');
        $slug->setSlug('product');
        $manager->persist($slug);

        $id = Uuid::fromString('7f36118c-f0d3-4a80-9d4a-a975929452d5');
        $template = new Template();
        $template->setName('ondernemers');
        $template->setDescription('ondernemers');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/ondernemers.html.twig', 'r'));
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
        $slug->setName('ondernemers');
        $slug->setSlug('ondernemers');
        $manager->persist($slug);

        $id = Uuid::fromString('70dd6462-85ef-45f4-b9dc-57eb9ac56646');
        $template = new Template();
        $template->setName('privacy');
        $template->setDescription('privacy');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/privacy.html.twig', 'r'));
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
        $slug->setName('privacy');
        $slug->setSlug('privacy');
        $manager->persist($slug);

        $id = Uuid::fromString('16da42d1-4be6-499d-8a82-94acde4eac25');
        $template = new Template();
        $template->setName('pitches');
        $template->setDescription('pitches');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/pitches.html.twig', 'r'));
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
        $slug->setName('pitches');
        $slug->setSlug('pitches');
        $manager->persist($slug);

        $id = Uuid::fromString('5c2164ad-b696-403c-999e-bc3ca92dd30a');
        $template = new Template();
        $template->setName('pitch');
        $template->setDescription('pitch');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/pitch.html.twig', 'r'));
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
        $slug->setName('pitch');
        $slug->setSlug('pitch');
        $manager->persist($slug);

        $id = Uuid::fromString('eec83f6b-602e-4f72-94ce-f5d3870dd61b');
        $template = new Template();
        $template->setName('challenges');
        $template->setDescription('challenges');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/challenges.html.twig', 'r'));
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
        $slug->setName('challenges');
        $slug->setSlug('challenges');
        $manager->persist($slug);

        $id = Uuid::fromString('8ca36a4e-8d4a-4fd7-a7c6-b7a87de1c379');
        $template = new Template();
        $template->setName('challenge');
        $template->setDescription('challenge');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/challenge.html.twig', 'r'));
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
        $slug->setName('challenge');
        $slug->setSlug('challenge');
        $manager->persist($slug);

        $id = Uuid::fromString('efb8eb07-1bea-4946-b160-e7e4198194c6');
        $template = new Template();
        $template->setName('proposal');
        $template->setDescription('proposal');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/proposal.html.twig', 'r'));
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
        $slug->setName('proposal');
        $slug->setSlug('proposal');
        $manager->persist($slug);

        $id = Uuid::fromString('93a13fa8-d81b-4e37-9fef-8320af96d0db');
        $template = new Template();
        $template->setName('deal');
        $template->setDescription('deal');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/proposal.html.twig', 'r'));
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
        $slug->setName('deal');
        $slug->setSlug('deal');
        $manager->persist($slug);

        $id = Uuid::fromString('03e7b509-9868-40d3-9ecf-5ef725be99e5');
        $template = new Template();
        $template->setName('question');
        $template->setDescription('question');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/question.html.twig', 'r'));
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
        $slug->setName('question');
        $slug->setSlug('question');
        $manager->persist($slug);

        $id = Uuid::fromString('71e84ed8-607a-4825-8240-695055be1e20');
        $template = new Template();
        $template->setName('new-pitch');
        $template->setDescription('new-pitch');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/new-pitch.html.twig', 'r'));
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
        $slug->setName('new-pitch');
        $slug->setSlug('new-pitch');
        $manager->persist($slug);

        // Template groups
        $id = Uuid::fromString('5c59f238-1ce3-4c8d-8107-4bd8e2134648');
        $groupNews = new TemplateGroup();
        $groupNews->setOrganization($organization);
        $groupNews->setApplication($application);
        $groupNews->setName('Nieuws');
        $groupNews->setDescription('Webpages about news articles');
        $manager->persist($groupNews);
        $groupNews->setId($id);
        $manager->persist($groupNews);
        $manager->flush();
        $groupNews = $manager->getRepository('App:TemplateGroup')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('0ace23c9-3c95-4675-994c-596b9ef0144b');
        $template = new Template();
        $template->setName('PI-event');
        $template->setTitle('PI-event is van start');
        $template->setDescription('Het PI-event is eindelijk van start! Tijdens dit event gaan verschillende gemeentes hun nieuwe platformen tonen.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/pi-event.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $date = new \DateTime();
        $date->sub(new \DateInterval('P2D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('pi-event');
        $slug->setSlug('pi-event');
        $manager->persist($slug);

        $id = Uuid::fromString('67b1e403-4436-4cd9-a328-ce99e05511a1');
        $template = new Template();
        $template->setName('huwelijksplanner');
        $template->setTitle('Zuid-Drecht lanceert huwelijksplanner');
        $template->setDescription('De gemeente Zuid drecht heeft in samenwerking met het bedrijf Conduction een huwelijksplanner gelanceerd. Dit project is in leven gebracht om het aanvragen van een huwelijk een fijne en soepele ervaring te maken.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/huwelijksplanner.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P4D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('huwelijksplanner');
        $slug->setSlug('huwelijksplanner');
        $manager->persist($slug);

        $id = Uuid::fromString('90035899-fd96-4998-9d38-db7b0f5940f9');
        $template = new Template();
        $template->setName('corona');
        $template->setTitle('Corona maatregelen in Zuid-Drecht');
        $template->setDescription('De corona maatregelen worden per 1 juli 2020 versoepeld in de gemeente Zuid-Drecht. De cijfers blijken dusdanig te dalen in deze gemeente, dat er weer steeds meer mogelijk is.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/corona.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P1D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('corona');
        $slug->setSlug('corona');
        $manager->persist($slug);

        $id = Uuid::fromString('12f475a7-151c-48b6-8b02-0e0dfcfc78d9');
        $template = new Template();
        $template->setName('groene stroom');
        $template->setTitle('Zuid-Drecht gaat over op groene stroom');
        $template->setDescription('De gemeente is sinds vandaag helemaal over op groene stroom. Dit is een heel groot project geweest, maar het is de gemeente Zuid-Drecht gelukt om in iets minder dan een jaar compleet over te gaan op groene stroom.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/groene-stroom.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P3D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('groene-stroom');
        $slug->setSlug('groene-stroom');
        $manager->persist($slug);

        $id = Uuid::fromString('272a5076-dfb0-4adf-b5ca-d3525e7a31bf');
        $template = new Template();
        $template->setName('Woninginbraken gehalveerd');
        $template->setTitle('Woninginbraken gehalveerd in de gemeente Zuid-Drecht');
        $template->setDescription('Woninginbraken lijken steeds minder voor te komen in de gemeente Zuid-Drecht. Uit cijfers blijkt dat dit vergeleken vorig jaar alweer gehalveerd is.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/woning-inbraak.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('woning-inbraak');
        $slug->setSlug('woning-inbraak');
        $manager->persist($slug);

        $id = Uuid::fromString('6d38b11f-2edb-4a4e-894a-5b4677da2c53');
        $template = new Template();
        $template->setName('Beste gemeente');
        $template->setTitle('Zuid-drecht is uitgeroepen tot beste gemeente van 2020');
        $template->setDescription('De jaarlijkse prijs uitreiking voor de beste gemeente van het jaar is weer voorbij. Dit jaar hebben we als winnaar de nog best jonge gemeente Zuid drecht.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/beste-gemeente.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P5D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('beste-gemeente');
        $slug->setSlug('beste-gemeente');
        $manager->persist($slug);

        // Template groups
        $groupEmails = new TemplateGroup();
        $groupEmails->setOrganization($organization);
        $groupEmails->setApplication($application);
        $groupEmails->setName('E-mails');
        $groupEmails->setDescription('E-mails that are send out');
        $manager->persist($groupEmails);

        $id = Uuid::fromString('3ad00211-9cc9-4100-9fef-effa8731b104');
        $template = new Template();
        $template->setName('Wijziging verzoek');
        $template->setTitle('Uw verzoek is gewijzigd');
        $template->setDescription('Bevestiging dat een verzoek is gewijzigd');
        $template->setContent('Beste {{ receiver.givenName }},<p>Uw verzoek met referentie {{ resource.reference }} is met succes gewijzigd.</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-wijziging');
        $slug->setSlug('e-mail-wijziging');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('06ec69cb-8af2-4c3c-8d75-436c3efa707b');
        $template = new Template();
        $template->setName('Herinnering melding');
        $template->setTitle('Vergeet geen melding te doen van uw huwelijk!');
        $template->setDescription('Herinnering voor het doen van een melding voor het huwelijk');
        $template->setContent('Beste {{ receiver.givenName }},<p>Vergeet niet om melding te doen van uw aanstaande huwelijk! U heeft nog 14 dagen.</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-herinnering');
        $slug->setSlug('e-mail-herinnering');
        $manager->persist($slug);
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
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'350156d4-4eca-4bec-bc48-c906f20d2bda']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'f62792c9-d229-43b9-8f6a-3b368eee6739']),
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

        $id = Uuid::fromString('bf8aff0a-ab65-4761-923b-890785c5d2fb');
        $template = new Template();
        $template->setName('Ontvangst Bevestiging Verzoek');
        $template->setDescription('Ontvangst Bevestiging Verzoek');
        $template->setContent('ontvangen');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('d52644b8-d0af-4102-976c-8737802e0b7c');
        $template = new Template();
        $template->setName('Order');
        $template->setDescription('Order');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Documents/order.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('d273afad-4a3d-426d-a621-55720cac5d4e');
        $template = new Template();
        $template->setName('Factuur');
        $template->setDescription('Factuur');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Documents/invoice.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $manager->flush();
    }
}
