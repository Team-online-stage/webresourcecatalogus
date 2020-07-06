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

        $logo = new Image();
        $logo->setName('stage Logo');
        $logo->setDescription('Logo stage');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('stage');
        $style->setDescription('Huistlijl stage');
        $style->setCss('');
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

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setName('stage.conduction.nl configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($stage);
        $configuration->setConfiguration(
            [
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'a10c80cb-8e93-44af-8393-c475da173328']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'7d53cc95-ca23-4068-880b-48731f804f69']),
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('a10c80cb-8e93-44af-8393-c475da173328');
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
        $groupPages->setApplication($stage);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('7d53cc95-ca23-4068-880b-48731f804f69');
        $template = new Template();
        $template->setName('stage.conduction.nl Home');
        $template->setDescription('home page voor stage.conduction.nl');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/index.html.twig', 'r'));
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
        $slug->setApplication($stage);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();



    }
}
