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

class UtrechtFixtures extends Fixture
{
    private $params;
    private $commonGroundService;

    public const ORGANIZATION_UTRECHT = 'organization-utrecht';

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->commonGroundService = $commonGroundService;
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'huwelijksplanner.online' && strpos($this->params->get('app_domain'), 'huwelijksplanner.online') == false &&
            $this->params->get('app_domain') != 'utrecht.commonground.nu' && strpos($this->params->get('app_domain'), 'utrecht.commonground.nu') == false
        ) {
            return false;
        }

        // Utrecht
        $id = Uuid::fromString('a5379571-cf8c-48e7-8811-6757efa11c5e');
        $organization = new Organization();
        $organization->setName('Utrecht');
        $organization->setDescription('De gemeente Utrecht');
        $organization->setRsin('002220647');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $this->addReference(self::ORGANIZATION_UTRECHT, $organization);

        $favicon = new Image();
        $favicon->setName('Utrecht Favicon');
        $favicon->setDescription('Utrecht VNG');
        $favicon->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Utrecht/afbeeldingen/wapen-utrecht-rood.svg', 'r')));
        $favicon->setOrganization($organization);

        $logo = new Image();
        $logo->setName('Utrecht Logo');
        $logo->setDescription('Utrecht Logo');
        $logo->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Utrecht/afbeeldingen/wapen-utrecht-rood.svg', 'r')));
        $logo->setOrganization($organization);

        $style = new Style();
        $style->setName('Utrecht');
        $style->setDescription('Huistlijl Gemeente Utrecht');
        $style->setCss('
        :root {
                --primary: #2A5587;
                --primary-color: white;
                --secondary: #FFB60A;
                --secondary-color: black;

                --menu: #333333;
                --menu-over: #3669A5;
                --menu-color: white;
                --footer: #CC0000;
                --footer-color: white;
         }');

        $style->setfavicon($favicon);
        $style->addOrganization($organization);

        $manager->persist($organization);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('Website');
        $configuration->setDescription('De website van de gemeente Utrecht');
        $configuration->setOrganization($organization);
        $configuration->setConfiguration(
            [
                'sideMenu'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'f6015c2e-1238-4726-8c31-6a3809e9e1ac']),
                'loggedIn'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'d99faa7b-4dc3-4423-85bc-fc6af769c858']),
                'mainMenu'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'afea3e07-ba59-4318-a6f3-3fad9a044584']),
                'home'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'8b630178-85a8-4f10-b19c-c421fdfa5299']),
                'footer1'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'9be5ac5d-35ce-4056-b5a9-ae6a7cf24ef8']),
                'footer2'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'2a85bdc1-3370-4847-b330-e8e6d9cd82b1']),
                'footer3'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'facad633-27a9-499a-b3fc-4687215bf82a']),
                'footer4'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'4bc966b6-e310-4bce-b459-a7cf65651ce0']),
                'nieuws'            => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'a28db4f3-f579-43db-bde7-9e0188fdd717']),
                'faq'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'6b243aa1-5ae6-4aeb-93d5-2f509fb34cef']),
                'newsimg'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'726da4ad-9979-4c04-9048-2c0fa7bdb800']),
                'headerimg'         => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'76b4c601-68a3-462b-a5fe-421c795d67bc']),
                'favicon'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'98df315f-63f0-4dc8-8321-a2cfa53f666e']),
                'colorSchemeFooter' => 'footerStyle',
                'colorSchemeMenu'   => 'menuStyle',
                'hubspotId'         => '6108438',
                'googleTagId'       => 'G-RHY411XSJN', ]
        );
        $manager->persist($configuration);

        // Website
        $id = Uuid::fromString('de22599d-b139-439c-8b67-8718815622a1');
        $application = new Application();
        $application->setName('Website');
        $application->setDescription('de website van de gemeente Utrecht');
        $application->setDomain('huwelijksplanner.online');
        $application->setDefaultConfiguration($configuration);
        $application->setOrganization($organization);
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // loggedIn menu
        $id = Uuid::fromString('d99faa7b-4dc3-4423-85bc-fc6af769c858');
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
        $menuItem->setName('Mijn Utrecht');
        $menuItem->setDescription('Stages');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/request');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Side menu
        $id = Uuid::fromString('f6015c2e-1238-4726-8c31-6a3809e9e1ac');
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
        $id = Uuid::fromString('afea3e07-ba59-4318-a6f3-3fad9a044584');
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
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

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

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organization);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        $groupMessages = new TemplateGroup();
        $groupMessages->setOrganization($organization);
        $groupMessages->setApplication($application);
        $groupMessages->setName('Berichten');
        $groupMessages->setDescription('Berichten die worden verstuurd rondom het huwelijks procces');
        $manager->persist($groupMessages);

        // Pages
        $id = Uuid::fromString('8b630178-85a8-4f10-b19c-c421fdfa5299');
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

        $id = Uuid::fromString('9be5ac5d-35ce-4056-b5a9-ae6a7cf24ef8');
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

        $id = Uuid::fromString('2a85bdc1-3370-4847-b330-e8e6d9cd82b1');
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

        $id = Uuid::fromString('1ad67f5d-eda7-4ff6-8b23-7539e8d703d2');
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

        $id = Uuid::fromString('1a1a540c-21dc-42c7-9aaf-162bc8819e5f');
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

        // Template groups
        $id = Uuid::fromString('a4e7c1a9-e59d-41f9-82ca-8a0e59865e26');
        $groupFaq = new TemplateGroup();
        $groupFaq->setOrganization($organization);
        $groupFaq->setApplication($application);
        $groupFaq->setName('FAQ');
        $groupFaq->setDescription('Meer informatie over zuid drecht');
        $manager->persist($groupFaq);
        $groupFaq->setId($id);
        $manager->persist($groupFaq);
        $manager->flush();
        $groupFaq = $manager->getRepository('App:TemplateGroup')->findOneBy(['id'=> $id]);

        $template = new Template();
        $template->setName('cookies');
        $template->setDescription('cookies');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/cookies.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('cookies');
        $slug->setSlug('cookies');
        $manager->persist($slug);

        $template = new Template();
        $template->setName('proclaimer');
        $template->setDescription('proclaimer');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/proclaimer.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('proclaimer');
        $slug->setSlug('proclaimer');
        $manager->persist($slug);

        $template = new Template();
        $template->setName('privacy');
        $template->setDescription('privacy');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/privacy.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('privacy');
        $slug->setSlug('privacy');
        $manager->persist($slug);

        // Template groups
        $id = Uuid::fromString('a28db4f3-f579-43db-bde7-9e0188fdd717');
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
    }
}
