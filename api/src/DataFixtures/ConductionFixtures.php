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

class ConductionFixtures extends Fixture
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
        // Lets make sure we only run these fixtures on larping enviroment
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'conduction.nl' && strpos($this->params->get('app_domain'), 'conduction.nl') == false) {
            return false;
        }
        //var_dump($this->params->get('app_domain'));

        // Deze organisaties worden ook buiten het wrc gebruikt
        $id = Uuid::fromString('6a001c4c-911b-4b29-877d-122e362f519d');
        $conduction = new Organization();
        $conduction->setName('Conduction');
        $conduction->setDescription('Conduction');
        $conduction->setRsin('');
        //$conduction->setContact('https://cc.huwelijksplanner.online/organizations/95c3da92-b7d3-4ea0-b6d4-3bc24944e622');
        $manager->persist($conduction);
        $conduction->setId($id);
        $manager->persist($conduction);
        $manager->flush();
        $conduction = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('Conduction Favicon');
        $favicon->setDescription('Favicon Conduction');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Conduction Logo');
        $logo->setDescription('Logo Conduction');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Conduction');
        $style->setDescription('Huistlijl Conduction');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $conduction->setLogo($logo);

        $manager->persist($conduction);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Website applicatie
        $id = Uuid::fromString('7a5e1617-815a-4630-bbb6-994f1c850c28');
        $website = new Application();
        $website->setName('website');
        $website->setDescription('website');
        $website->setDomain('conduction.nl');
        $website->setOrganization($conduction);
        $manager->persist($website);
        $website->setId($id);
        $manager->persist($website);
        $manager->flush();
        $website = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Dashboard applicatie
        $id = Uuid::fromString('6ce4dc4c-3db5-417c-ab15-4b823b81605c');
        $dashboard = new Application();
        $dashboard->setName('Huwelijksplanner');
        $dashboard->setDescription('Huwelijksplanner');
        $dashboard->setDomain('db.conduction.nl');
        $dashboard->setOrganization($conduction);
        $manager->persist($dashboard);
        $dashboard->setId($id);
        $manager->persist($dashboard);
        $manager->flush();
        $dashboard = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        $manager->flush();

        /*
         * ZaakOnline
         */

        $favicon = new Image();
        $favicon->setName('Zaakonline Favicon');
        $favicon->setDescription('Favicon ZaakOnline');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Zaakonline Logo');
        $logo->setDescription('Logo ZaakOnline');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Zaakonline');
        $style->setDescription('Huistlijl ZaakOnline');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('8bcc5b9d-bc9f-4981-bba5-7441ef51af5e');
        $zaakOnline = new Application();
        $zaakOnline->setName('Zaakonline');
        $zaakOnline->setDescription('Website voor Zaakonline');
        $zaakOnline->setDomain('zaakonline.nl');
        $zaakOnline->setStyle($style);
        $zaakOnline->setOrganization($conduction);
        $manager->persist($zaakOnline);
        $zaakOnline->setId($id);
        $manager->persist($zaakOnline);
        $manager->flush();
        $zaakOnline = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setName('zaakonline configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($zaakOnline);
        $configuration->setConfiguration(
            [
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'bb05a4b3-5eca-4cf0-83a9-8fcf41dcc40f']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'6e01b18c-6751-4e11-9430-c69f629a6760']),
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('bb05a4b3-5eca-4cf0-83a9-8fcf41dcc40f');
        $menu = new Menu();
        $menu->setName('zaakonline Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($zaakOnline);
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
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($zaakOnline);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('6e01b18c-6751-4e11-9430-c69f629a6760');
        $template = new Template();
        $template->setName('zaakonline Home');
        $template->setDescription('De homepage voor zaakonline');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zaakonline/index.html.twig', 'r'));
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
        $slug->setApplication($zaakOnline);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        /*
         * Commonground.nu
         */

        $favicon = new Image();
        $favicon->setName('Commonground.nu Favicon');
        $favicon->setDescription('Favicon Commonground.nu');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Commonground.nu Logo');
        $logo->setDescription('Logo Commonground.nu');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('commonground.nu');
        $style->setDescription('Huistlijl commonground.nu');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('86ca72d4-b40e-45cf-bb8c-1a17ba65ad52');
        $commongroundNu = new Application();
        $commongroundNu->setName('Commonground.nu');
        $commongroundNu->setDescription('Website voor commonground.nu');
        $commongroundNu->setDomain('commonground.nu');
        $commongroundNu->setStyle($style);
        $commongroundNu->setOrganization($conduction);
        $manager->persist($commongroundNu);
        $commongroundNu->setId($id);
        $manager->persist($commongroundNu);
        $manager->flush();
        $commongroundNu = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setName('commonground.nu configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($commongroundNu);
        $configuration->setConfiguration(
            [
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'447eb167-17b0-416a-9df4-7cd4d3cc417c']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'83b365c9-33fe-4b89-99d0-d77ef676adb1']),
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('447eb167-17b0-416a-9df4-7cd4d3cc417c');
        $menu = new Menu();
        $menu->setName('commonground.nu Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($commongroundNu);
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
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($commongroundNu);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('83b365c9-33fe-4b89-99d0-d77ef676adb1');
        $template = new Template();
        $template->setName('commonground.nu Home');
        $template->setDescription('Homepage voor commonground.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CommongroundNu/index.html.twig', 'r'));
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
        $slug->setApplication($commongroundNu);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        /*
         * Common-ground.dev
         */

        $favicon = new Image();
        $favicon->setName('Common-ground.dev Favicon');
        $favicon->setDescription('Favicon Common-ground.dev');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Common-ground.dev Logo');
        $logo->setDescription('Logo Common-ground.dev');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Common-ground.dev');
        $style->setDescription('Huistlijl Common-ground.dev');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('283dc171-605f-4e17-9e75-3d161d4b097c');
        $commongroundDev = new Application();
        $commongroundDev->setName('Common-ground.dev');
        $commongroundDev->setDescription('Website voor common-grond.dev');
        $commongroundDev->setDomain('common-ground.dev');
        $commongroundDev->setStyle($style);
        $commongroundDev->setOrganization($conduction);
        $manager->persist($commongroundDev);
        $commongroundDev->setId($id);
        $manager->persist($commongroundDev);
        $manager->flush();
        $commongroundDev = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setName('common-ground.dev configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($commongroundDev);
        $configuration->setConfiguration(
            [
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'15db60f7-76f1-4bc0-8caf-cb9ed9d4066f']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'cdc7b532-2084-470e-9032-935bb8e5bde4']),
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('15db60f7-76f1-4bc0-8caf-cb9ed9d4066f');
        $menu = new Menu();
        $menu->setName('common-ground.dev Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($commongroundDev);
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
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($commongroundDev);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('cdc7b532-2084-470e-9032-935bb8e5bde4');
        $template = new Template();
        $template->setName('common-ground.dev Home');
        $template->setDescription('Homepage voor common-ground.dev');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CommongroundDev/index.html.twig', 'r'));
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
        $slug->setApplication($commongroundDev);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        /*
        * stage.conduction.nl
        */

        $favicon = new Image();
        $favicon->setName('stage Favicon');
        $favicon->setDescription('Favicon stage');
        $favicon->setOrganization($conduction);

        $id = Uuid::fromString('b0e3e803-2cb6-41ed-ab32-d6e5451c119d');
        $newsimg = new Image();
        $newsimg->setName('news image');
        $newsimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/afbeeldingen/stage_news.jpg', 'r')));
        $newsimg->setDescription('Stage news');
        $newsimg->setOrganization($conduction);
        $manager->persist($newsimg);
        $newsimg->setId($id);
        $manager->persist($newsimg);
        $manager->flush();
        $newsimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('0863d15c-286e-4ec4-90f6-27cebb107aa9');
        $headerimg = new Image();
        $headerimg->setName('header image');
        $headerimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/afbeeldingen/stage_header.jpg', 'r')));
        $headerimg->setDescription('Stage header');
        $headerimg->setOrganization($conduction);
        $manager->persist($headerimg);
        $headerimg->setId($id);
        $manager->persist($headerimg);
        $manager->flush();
        $headerimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('stage Logo');
        $logo->setDescription('Logo stage');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('stage');
        $style->setDescription('Huistlijl stage');
        $style->setCss(':root {--primary: #ffbc2c;--primary2: white;--secondary: #ffc446;--secondary2: #ffc446;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;}

        a {
            text-decoration: none;
        }

        a:focus:not(.btn):not(.pagination__link):not(.nav__link){
            background: #FFBC2C;
            outline: none;
        }

        .headerImage {
            margin-top: -20px;
            height: 500px;
            background: none;
            background-size: cover !important;
            background-position: center !important;

        }

        .newsImage {
            display: none;
            margin-top: 50px;
            padding: 25px;
            margin-bottom: -50px;
            background: none;
            background-size: cover !important;
            background-position: center !important;
            }

        #news-1, #news-2, #news-3, #news-4 {
            display: none;
        }

        @media only screen and (min-width: 600px){

            .newsImage {
                display: block;
                margin-top: 50px;
                padding: 25px;
                margin-bottom: -50px;
                background: none;
                background-size: cover !important;
                background-position: center !important;
            }

            #news-1, #news-2 {
                display: block;
            }
        }

        @media only screen and (min-width: 900px){
            #news-3 {
                display: block;
            }
        }

        @media only screen and (min-width: 1200px){
            #news-4 {
                display: block;
            }
        }





        @media only screen and (min-width: 1376px){
            .headerImage {
                margin-top: -20px;
                height: 500px;
                background: none;
                background-size: 100% auto !important;
                background-position: center !important;
            }

            .newsImage {
                margin-top: 35px;
                padding: 25px;
                margin-bottom: -50px;
                background: none;
                background-size: 100% auto !important;
                background-position: center !important;
            }
        }

        .processen ul {
            clear: left;
            padding: 0 .5em
        }

        @media only screen and (min-width: 35em) {
            .processen ul {
                padding:0
            }

            .processen ul li {
                width: 32%;
                float: left;
                margin-right: 2%
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul {
                padding-right: .8em;
            }

            .processen ul li {
                width: 19%;
                float: left;
                margin-right: 1.25%
            }
        }

        .processen ul li {
            list-style: none;
            margin-top: 0;
            margin-bottom: .6em;
            padding: 0;
            background-image: none
        }

        @media only screen and (min-width: 35em) {
            ,.processen ul li:nth-child(3n) {
                margin-right:0
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul li:nth-child(3n) {
                margin-right:1.25%
            }

            .processen ul li:nth-child(5n) {
                margin-right: 0
            }

            .processen:after {
                display: none
            }

            .processen ul {
                width: 66.67%;
                float: left
            }
        }

        .processen ul li{
            background-image: none;
            padding-left: 0
        }

        @media only screen and (min-width: 35em) {
            .processen ul li {
                width:48%
            }

            .processen {
                margin-left: 17px;
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul li {
                width:32%;
                float: left;
                margin-bottom: .8em;
                margin-right: 2%

            }

            .processen {
            margin-left: 0px;
            }
        }

        @media only screen and (min-width: 35em) {
            .processen ul li:nth-child(2n) {
                margin-right:0
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul li:nth-child(2n) {
                margin-right:2%
            }

            .processen ul li:nth-child(3n) {
                margin-right: 0
            }

            .processen ul li:nth-child(5n) {
                margin-right: 2%
            }

            .processen a {
                min-height: 10.2em
            }
        }

        .processen {
            margin: 0 -1.2em
            margin-top: 25px;
        }

        @media only screen and (min-width: 35em) {
            .processen li:nth-child(3n) {
                margin-right:2%
            }
        }

        @media only screen and (min-width: 60em) {
            ..processen li:nth-child(3n) {
                margin-right:0
            }
        }

        .processen ul {
            margin-top: 0;
            margin-left: 0;
        }

        .processen a {
            display: block;
            text-align: center;
            position: relative;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: #ffbc2c;
            color: #FFF;
            text-decoration: none;
        }

        .processen a:hover {
            background-color: #FFC446;
            border-color: #FFC446;
            transform: scale(1.02)
        }

        .processen a span {
            font-size: 1.25em
        }

        @media only screen and (min-width: 35em) {
            .processen a {
                padding:2.5em .75em .75em;
                min-height: 9em
            }

            .processen a span {
                font-size: 1.125em;
                line-height: 1.2
            }
        }


        .header-logo a:after{
            background-image: none;
        }

        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footerStyle {
            background-color: #ffbc2c;
        }

        .top-nav-autoresize .nav__link:hover {
            background-color: #ffc446;
        }

        .menuStyle {
            background-color: #ffbc2c;
        }

        .newsCard {
        margin: 10px auto;
        width: 240px;
        background-color: white;
        padding: 15px;
        height:400px;
        }

        .contact {
        background-color: #ffbc2c;
        float:left;
        width: 100%;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        margin-left: 5px;
        }

        @media only screen and (min-width: 960px) {
            .contact {
                background-color: #ffbc2c;
                float:left;
                width: 33%;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 10px;
                margin-left: 0px;
            }
        }

        .header-logo a:before {
        background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMjIxIiBoZWlnaHQ9IjIxOSIgdmlld0JveD0iMCAwIDIyMSAyMTkiPgogIDxtZXRhZGF0YT48P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/Pgo8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzE0MiA3OS4xNjA5MjQsIDIwMTcvMDcvMTMtMDE6MDY6MzkgICAgICAgICI+CiAgIDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+CiAgICAgIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiLz4KICAgPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgIAo8P3hwYWNrZXQgZW5kPSJ3Ij8+PC9tZXRhZGF0YT4KPGltYWdlIHdpZHRoPSIyMjEiIGhlaWdodD0iMjE5IiB4bGluazpocmVmPSJkYXRhOmltZy9wbmc7YmFzZTY0LGlWQk9SdzBLR2dvQUFBQU5TVWhFVWdBQUFOMEFBQURiQ0FNQUFBRGVRMlExQUFBQUJHZEJUVUVBQUxHUEMveGhCUUFBQUNCalNGSk5BQUI2SmdBQWdJUUFBUG9BQUFDQTZBQUFkVEFBQU9wZ0FBQTZtQUFBRjNDY3VsRThBQUFDaFZCTVZFWC8vLy9sN1AvajYvOTZudjFEZHZ6MDkvK1hzLzFIZWZ5WXRQMysvdisxeWY1U2dmeFRndnpSM3Y1bmtQM1MzdjdwNy8rQ3BQMkRwZjM0K3YrZ3V2MUpldnlodXYyOXovNVloZnhZaHZ6WjVQNXVsdjNhNVA3dTgvK0xxLzFFZC95TXEvMzcvUCtvd1A1TmZmeXB3UDdHMXY1ZWlmeGVpdnpnNlA5M25QM2g2Zi95OXYrVXNmMUZlUHo4L2YreXgvNVFnUHhSZ1B6OS9mL1AzUDVranYzbjdmOS9vdjMyK2YrY3QvMUlldnk2elA1VmcveFdoUHk2emY3VzRmNXNsUDNzOGYrSXFQMklxZjM1Ky8rbXZ2NUxmUHpEMC81YmgveGJpUHplNS81em1mM3g5ZitRcnYydXhQNVBmL3pMMmY1aGpQeGlqZnprN1A5OG4vMzE5LytadGYybHZmNjN5djdVMy81b2tmMXBrZjNxNy8rRXBmM3E4UCtodS81S2UveWJ0djIvMFA1Wmh2emI1ZjV3bC8zTzNQN3Y4LytOclAycXdmNU5mdnlUc2YzSTEvNWZpdnppNnY5NG5mM0YxZjd6OXYrVnN2MUdlUHlXc3YyenlQNkxxdjNRM2Y1bWovMXVsZjNuN3YrQm8vMzMrZitldVAyZXVmMjh6djdvN3YvWDR2NXRsZjFta1AzdDh2K0pxZjM2Ky8rbnYvNU1mUHpFMVA1Y2lQemY1LzUxbS8xZ2kvekoyUDZzdy83eTlmK1NyLzFPZnZ6SzJQNVFmL3lPcmYzdzlQOXhtUDNjNXY3SDF2N0EwZjVhaC95a3ZQNkZwdjNyOFA5cWt2M1Y0UDVVZ3Z5NHkvNkFvLzMxK1ArZHVQMTlvUDFqamYzTjJ2NnZ4ZjUwbWYyUnIvMnZ4UDZhdGYyM3kvN1U0UDdkNXY2aXUvN0IwdjY3enY2Mnl2NkhwLzFyay8xN24vM2s2Lys1elA1bGovMnR3LzdtN2Y5K29mMWpqdjF5bVAyeHh2N0MwdjdmNlA1Mm0vMWRpZnpjNWY1MG12M00ydjVwa3YyanZQNXhsLzJzd3Y1NW5mMjB5UDdZNC81WGhmelIzZjdaNC82cnd2NXZsdjIrMFA3VDMvNlp0UDBBQUFCZ1dOektBQUFBQVdKTFIwVFc1N1ZxcVFBQUFBbHdTRmx6QUFBdUl3QUFMaU1CZUtVL2RnQUFBQWQwU1UxRkIrUUhCeEFSSldvTlE3b0FBQWkrU1VSQlZIamE3WjMzUXhSSEZNZFBHSE9lSUlLSWlvcDROa1E5c0tDSW9xSTBDNmlJTFZpd1lDK0F2WGNGdXdaTHhJYXh4aGcxaVNZbUpsRmlpVEZSWThyL2t4dE9oWVBiM2ZkMlozZUd6WHgrdnB0NTM3dGplVFB6bmZjY0RvbEVJcEZJT05DRWR3QW1FaFJNZ29ONEIyRVNUVDl5RWtLY3pacnlEc1FFWE0xRGlJL1E1aTdld2JDbVJSaXBKYXdsNzNDWUVoNUIvR2tWempza1prUzJqaUwxaVdvVHlUc3NKcmphdGlPQmlHNXJneisvOWgySUVoMDY4ZzdPSURHZFlva3lzWjFqZUFkb0FIZVhya1NkcnQzY3ZJUFVTL2NlUkp1NDdyekQxRVhQZUlBMlNud3YzcUdpNmQzSEF4UkhpS2RQYjk3aG9raEk3QXZXUnVtWDJKOTN5SEFHSktHMFVaSUc4QTRheU1CQmFHMlVRUU41Qnc0Z2VYQ0tMbkdFcEF4TzVoMjhCcTRoUTNWcW82UU9Fem81R3o3Q2dEYktpT0c4SlNpU050S2dOc3FvTk40eUFwS2VrY2xBSENHWkdlbThwVFFrSzV1Sk5zcm9MTjVpNmpGbUxETnRsTEZqZUF1cXc3Z2NlTm9GdzVNempyZW9keVRram1lc2pUSStONEczTU1xRWlZaVlveEd2elp2QVc1cGpVajRpWHUvakF2WHd5Wi9FVmR2a0tVNTRyTDVIZmZwVXhEOE81NVRKM0xTNXBvVWl2b2dQLzZaUi8vUkRwM0ZLenFaL2pJalNMOFZDSld3RjB6bG9tekVURVdIcUVQOXZBSmRzejV4bHNiYkkyWVh3NkFJdGJaTG5JQlpLaGJPdDNMaDJ6WjJIK09nVmxxV29SZTY4dVphSm0xK0VpRXRsUzJGQkVtS2Nvdm1XYUZ1NEtCWWVVNzlFdFl3RHRia1V1MmloNmRyY2k1ZkFBOUxleXV1OUZKR2hMbGxzOHNiMXN1V0lIMU44VDhDSTRFMWR5dkpsSm1wYnNSSVJTUS9vRm5veFpFUCtQU3RYbUtTdHBIUVZQQXJNOFlmMllVb2RWcTB1TVVGYi96VWg4QkJpTytHT3JtTFdJcDVVSVd1WWIxeXZXNC80K1hSb2p4Ni8vUWJFK092WE1kVzJjUk5pN25hNmpveVZEcUFEczJrak0yMmJ0MFRCNTlWLzNCL0lQS0E4emRiTlRMUzV0cVVpUHRTSWNBTlRiWTlBekpTNmpjSGFhTWRPeEl4aExRek8xbUlYWXJhZE93ek90bnNQNW1IR3dDSlZhN2dDRUx0bnQ0R3A5dTRyZzAvbC9JaU52YzFubGdOU3RtK3Yzbm5LOXlOK0pneXRpVUhCaUhuM2wrdWE0OEJCeEJ5SERrT0dkQitKaHhsd0RoOUN6SDN3QUZyYjBXT0k1UDM0RVZEYTlja2hzQUhIZmVRNGZIclBzYU00Y2NVVjhNRmpUNXlFRFBuKzk3WUVsb0dlUElGNG5sVVVvOVNWd2tjK2RSb3lZTk5tdGMrS3VFOUJNWncrQlEraTFCeDEyV2NndzdtYSsrOThBZzA0WnlxNXFpczhDMHE3V29iVmY2T25GR1RBaVR3TDNIb3pROTI1ODVDeHdnUG1WeUV3QTg3NWM1elVYYmdJK3ZqYktPWEdTYkIxek1VTEhOUlZYWUtrWGVycm1zOUFCaHpYcFNxTDFUbm5YSVlNbzJLc3JTSGxDbWdkYzNtT1ZuTEdWTjFWMEkwWGRXT3RENkFCcDhsVnk5UmR1dzRad3QwTnRoYzBZZ2Nvb3V2WExGRlhjUU4wb0EweTF2cllrd1laTU9HR1N2N0VTQjB3cDBQdHdaS3lETkE2UmlYM1phTU9sbzlqakxVK2dBWWN4WFVMQzNWTzBGb0thNnoxOFRuTWdGTWUrT25KUXQxeHlGdDFHR3RyOE53RUdYQUNyNHdzVXFmVFdGdER4UmVBNXhWSGRmcU50VDRBQmh4dTZvd1phMzFjMVRMZzhGSm4yRmhiZy9PV3VnR0hqem9teHRvYXFyNVVTODU0cUVQNW96UXB1QzJVT29iR1doL25GQTA0bHF1N3c5WllXMFBoWFlVOURZdlZzVGZXK3FqOFNnQjFpV1lZYXlrS0t5TnIxWUUzNVdvQTc4Q21mcTN3NEJSWFhlZzNNKzZCWGhpMVJYRkhRbFIxUHFQczhQdmFyOXlrc3Bza3FMcHZ2L085d2ZWQUkxLzdYblVuVUVoMUUrdmt4NnJlVEMwM2lvRHF4di9ndjdaNStLUENDMWVWbG1oRUpwdzZUMDdESTdBRlB3VjY1VXJ0MHhQUjFQMThKOUFNQ1k4YTdFL0VRUng4WXFuTGZxdzBSejF2SnRCOUtaSzZ6S2xxbCttcWYvbndRckJ6VmlCMTk3U093SXFmK0Y1WUJDN1hJWXk2KzRCTHJPNTlYUW1Kbmd1MzhRaWlidWdEV01neG5WRzNEY1JRdHhSMEJJWkhESFZQelJFbjFVbDFVcDFVSjlWSmRWS2RWQ2ZWU1hWU25WUW4xVWwxVXAxVUo5VkpkVktkVkNmVnliM29XbXg5amtEc2ZRWkVzZlA1SGJINTJTdXg5N2s1eGM2ZUIySnp2d3F4dDllSVltZWZHTVhPSGo5aWMzOG1zYmUzbHRMWWZOSDI5clRiK3o2Q3c5NTNTU2gydmdma3NQa2RMb2U5Nzk5UjdIeDMwbUh6ZTY4T2U5OVpwdGo1dmptbDBkWUtzSGVkQjBLZWNhN1I4VXpoL2F6cXE5emtXRi9scHNuMVZZaTlhK05ROHA1RGhtQmMxK2g1bnRvZ3NpWVZXSjAzWDdLMG50Z3RTK3VKRVh2WGdxTmN1QTBaeVhBZHY5dS9BbUtSTlJpeDZramhDNVByWjc3Z1dEL1RTNldOYTU5U1RvSGNEVHJxMWo3OURSNEVUcDI5YXc0ajYwVy9aRjR2K3FXWjlhSzlWRGVhV3QvVmFHMlU4aWVJT1lMWk5YdFo4VHRpM2lmNjZyUTdiRjVqMzhHalA4SWZsdlZIb0x6QzlMYllaVzF2aTFlR1AweUhhOXRyeEl3UjJ3MU1oZXBMOHBwRlh4SXZtN2RpbXIyMGJsUTlaU2lXOUFOQy9VVFk5UU9pdk1IMGN0cUE3K1gwSjZxWDB4dW0yaHpZUGx4ckcxY2ZMaThscXpFOTFMbzBxaDVxRkZ6L08yaG1XNHhKaVV6cmYwZGgzN3V3V3BqZWhWN2Niem4yblh4cmN0OUpCN0puYUYvMW5xR1BCT3NaU3NIMWUxMmdPRTVnajZZQ1JXWmRjR2dJaTE2OUR6SG5tSlhXOWVyMUVublgwajdMZDYzc3MweVpoZW1SUGJSK2oyd3RqNllmbHZmSXBrd3ZRRVRvMzk4YzROSDhRQUZveTVzOXVONzBJOVBldmUwOHhyZFR4YXMzdlpmSm1vY3pkY2pNb0RjdlVKNHJMV3VPMlV6S1Izd1IyVm1PeHhpL1hMNldOY2Q4SnVRaDRzWDBkQVZZY3l3Z0lkY01lMjFGTHVoNDNnTFkyMnM5T1NCcmprV01ZV3V2QlZwenJDTnJORE50UUd1T3BhUm5zTEhYbG1Xa0d3L0dCTkpHTVJBM0tvMjNERVVNMjJ1QjFoeE91SVpoR21yWEIyak40WWgrZTIzS2xXVGowNXVPVG52dElKQTFSd0IwMkd1QjFod2g2Si9ZRDZVTmFNMFJCb3k5Rm1qTkVZcGUwRzFZb0RWSE5MckhBYlFCclRrQ29tMnZCVnB6QkVYZFhndTA1Z2hNUjJWNzdWL2d3aHppNG1vYkhWQmI5TitpcDEwd0F0bHJDOXRZdmIxc0hnM3N0YTNDZVlmRUZEOTdiZGcvdk1OaFRhMjlOcFNCNFVvOGZQWmE1NzlzekhMaUVSUk1nb040QjJFaUQza0hJSkZJSkpML0ovOEI1bk54NTF0ZDZwSUFBQUFBU1VWT1JLNUNZSUk9Ii8+Cjwvc3ZnPg==") no-repeat bottom;
        background-size: 90%;
        content: ;
        left:  0;
        position: absolute;
        top: 0;}

        .footer3, .footer4 {
        display: none;
        }

        @media only screen and (min-width: 767px) {
            .footer3 {
                display: block;
            }
        }

        @media only screen and (min-width: 992px) {
            .footer4 {
                display: block;
            }
        }

        .challenge-card-picture {
            display: none;
        }

        @media only screen and (min-width: 1205px) {
            .challenge-card-picture {
                display: block;
            }
        }

        ');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('be1fd311-525b-4408-beb1-012d27af1ff3');
        $stage = new Application();
        $stage->setName('Stage');
        $stage->setDescription('Website voor stage.conduction.nl');
        $stage->setDomain('stage.conduction.nl');
        $stage->setStyle($style);
        $stage->setOrganization($conduction);
        $manager->persist($stage);
        $stage->setId($id);
        $manager->persist($stage);
        $manager->flush();
        $stage = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('stage.conduction.nl configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($stage);
        $configuration->setConfiguration(
            [
                'mainMenu'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'da3d55e3-6b7e-47f3-856d-eb158212d8af']),
                'home'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'6079cc7d-7b69-4db3-ad17-6bf972cca6a2']),
                'footer1'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'09dfc502-19ce-4b11-8e0a-a7fc456a5c52']),
                'footer2'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'23b58ab8-45a6-4fbf-a180-6aac96da4df6']),
                'footer3'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'b86881b2-7911-4598-826d-875acc899845']),
                'footer4'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'b0c69fb9-852f-4c54-80c7-7b0f931e779a']),
                'nieuws'            => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'f2729540-2740-4fbf-98ae-f0a069a1f43f']),
                'newsimg'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'b0e3e803-2cb6-41ed-ab32-d6e5451c119d']),
                'headerimg'         => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'0863d15c-286e-4ec4-90f6-27cebb107aa9']),
                'colorSchemeFooter' => 'footerStyle',
                'colorSchemeMenu'   => 'menuStyle',
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('da3d55e3-6b7e-47f3-856d-eb158212d8af');
        $menu = new Menu();
        $menu->setName('stage.conduction.nl Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($stage);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('De Home Pagina');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/home');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Over');
        $menuItem->setDescription('Over');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/over');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Stages');
        $menuItem->setDescription('Stages');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/stages');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Tutorials');
        $menuItem->setDescription('Tutorials');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/tutorials');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Challenges');
        $menuItem->setDescription('Challenges');
        $menuItem->setOrder(5);
        $menuItem->setType('slug');
        $menuItem->setHref('/challenges');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($stage);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('6079cc7d-7b69-4db3-ad17-6bf972cca6a2');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('Stage Home Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/index.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $id = Uuid::fromString('a7cd9c16-4d5c-45bd-a95c-3dd931e53b0e');
        $template = new Template();
        $template->setName('Over');
        $template->setDescription('Stage Over Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/over.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('over');
        $slug->setSlug('over');
        $manager->persist($slug);

        $id = Uuid::fromString('3bfd1aba-c2af-4e50-be81-d7a86c9fe70b');
        $template = new Template();
        $template->setName('Stages');
        $template->setDescription('Stage Stages Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/stages.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('stages');
        $slug->setSlug('stages');
        $manager->persist($slug);

        $id = Uuid::fromString('73332c62-c2bf-4aeb-a3ca-a397863e1d04');
        $template = new Template();
        $template->setName('Tutorials');
        $template->setDescription('Stage Tutorials Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/tutorials.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('tutorials');
        $slug->setSlug('tutorials');
        $manager->persist($slug);

        $id = Uuid::fromString('cad4760e-703d-4de6-aefb-1ce11e9ff829');
        $template = new Template();
        $template->setName('Challenges');
        $template->setDescription('Stage Challenges Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/challenges.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('challenges');
        $slug->setSlug('challenges');
        $manager->persist($slug);

        $id = Uuid::fromString('bb1ed90e-e529-4f80-a486-5c58583d835c');
        $template = new Template();
        $template->setName('Studenten');
        $template->setDescription('Stage Studenten Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/studenten.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('studenten');
        $slug->setSlug('studenten');
        $manager->persist($slug);

        $id = Uuid::fromString('89ddaf33-9b5f-4651-9f12-c35122da5a34');
        $template = new Template();
        $template->setName('Teams');
        $template->setDescription('Stage Teams Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/teams.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('teams');
        $slug->setSlug('teams');
        $manager->persist($slug);

        $id = Uuid::fromString('09dfc502-19ce-4b11-8e0a-a7fc456a5c52');
        $template = new Template();
        $template->setName('footer1');
        $template->setDescription('footer1');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('23b58ab8-45a6-4fbf-a180-6aac96da4df6');
        $template = new Template();
        $template->setName('footer2');
        $template->setDescription('footer2');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('b86881b2-7911-4598-826d-875acc899845');
        $template = new Template();
        $template->setName('footer3');
        $template->setDescription('footer3');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('b0c69fb9-852f-4c54-80c7-7b0f931e779a');
        $template = new Template();
        $template->setName('footer4');
        $template->setDescription('footer4');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('17f556f4-105a-44df-a74c-1dccc9f22979');
        $template = new Template();
        $template->setName('nieuwsoverzicht');
        $template->setDescription('nieuwsoverzicht');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/nieuwsoverzicht.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('nieuwsoverzicht');
        $slug->setSlug('nieuwsoverzicht');
        $manager->persist($slug);

        $id = Uuid::fromString('3f19d75d-086e-46ad-a6dc-b7a355deffba');
        $template = new Template();
        $template->setName('article');
        $template->setDescription('article');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/article.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('article');
        $slug->setSlug('article');
        $manager->persist($slug);

        // Template groups
        $id = Uuid::fromString('f2729540-2740-4fbf-98ae-f0a069a1f43f');
        $groupNews = new TemplateGroup();
        $groupNews->setOrganization($conduction);
        $groupNews->setApplication($stage);
        $groupNews->setName('Nieuws');
        $groupNews->setDescription('Webpages about news articles');
        $manager->persist($groupNews);
        $groupNews->setId($id);
        $manager->persist($groupNews);
        $manager->flush();
        $groupNews = $manager->getRepository('App:TemplateGroup')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('21218de7-2750-4ed0-a7bb-9f13906f22b5');
        $template = new Template();
        $template->setName('pi event');
        $template->setTitle('pi event is van start');
        $template->setDescription('Het Pi event is eindelijk van start! In dit event gaan verschillende gemeentes hun nieuwe platformen tonen.');
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
        $slug->setApplication($stage);
        $slug->setName('pi-event');
        $slug->setSlug('pi-event');
        $manager->persist($slug);

        $manager->flush();
    }
}
