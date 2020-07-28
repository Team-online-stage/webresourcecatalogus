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

class WestfrieslandFixtures extends Fixture
{
    private $params;
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' && strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' && strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false
        ) {
            return false;
        }
        // West-Friesland
        $id = Uuid::fromString('d280c4d3-6310-46db-9934-5285ec7d0d5e');
        $westfriesland = new Organization();
        $westfriesland->setName('Westfriesland');
        $westfriesland->setDescription('Samenwerkingsverband Westfriesland');
        $westfriesland->setRsin('1234');
        $westfriesland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $manager->persist($westfriesland);
        $westfriesland->setId($id);
        $manager->persist($westfriesland);
        $manager->flush();
        $westfriesland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Opmeer
        $id = Uuid::fromString('16fd1092-c4d3-4011-8998-0e15e13239cf');
        $opmeer = new Organization();
        $opmeer->setName('Opmeer');
        $opmeer->setDescription('Gemeente Opmeer');
        $opmeer->setRsin('1234');
        $opmeer->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '26dee7a2-0fb6-4cc8-b5f6-0b5e2f8aa789']));
        $manager->persist($opmeer);
        $opmeer->setId($id);
        $manager->persist($opmeer);
        $manager->flush();
        $opmeer = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Medemblik
        $id = Uuid::fromString('429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $medemblik = new Organization();
        $medemblik->setName('Medemblik');
        $medemblik->setDescription('Gemeente Medemblik');
        $medemblik->setRsin('1234');
        $medemblik->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '47c8c694-62bb-4dec-b054-556537e896fe']));
        $manager->persist($medemblik);
        $medemblik->setId($id);
        $manager->persist($medemblik);
        $manager->flush();
        $medemblik = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // SED
        $id = Uuid::fromString('7033eeb4-5c77-4d88-9f40-303b538f176f');
        $sed = new Organization();
        $sed->setName('SED');
        $sed->setDescription('Gemeenten Stede Broec, Enkhuizen en Drechterland');
        $sed->setRsin('1234');
        $sed->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '0012428b-dc06-444a-af20-17d3ee06a916']));
        $manager->persist($sed);
        $sed->setId($id);
        $manager->persist($sed);
        $manager->flush();
        $sed = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Hoorn
        $id = Uuid::fromString('d736013f-ad6d-4885-b816-ce72ac3e1384');
        $hoorn = new Organization();
        $hoorn->setName('Hoorn');
        $hoorn->setDescription('Gemeente Hoorn');
        $hoorn->setRsin('1234');
        $hoorn->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '816395fc-4ba4-4fa5-90e9-780bb14a50c2']));
        $manager->persist($hoorn);
        $hoorn->setId($id);
        $manager->persist($hoorn);
        $manager->flush();
        $hoorn = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Koggenland
        $id = Uuid::fromString('f050292c-973d-46ab-97ae-9d8830a59d15');
        $koggenland = new Organization();
        $koggenland->setName('Koggenland');
        $koggenland->setDescription('Gemeente Koggenland');
        $koggenland->setRsin('1234');
        $koggenland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '5792b63d-afb5-4689-990b-51eec52b663b']));
        $manager->persist($koggenland);
        $koggenland->setId($id);
        $manager->persist($koggenland);
        $manager->flush();
        $koggenland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $favicon = new Image();
        $id = Uuid::fromString('0923599d-5182-4a1b-bc9b-72e18f88fc68');
        $favicon->setName('West-Friesland Favicon');
        $favicon->setDescription('West-Friesland VNG');
        $favicon->setBase64('data:image/x-icon;base64,AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAx0PkAjk8tAIxOMABOrssALtH/AIxLKAAv0f8AfWZZADDR/wAx0f8AQbjZACrX/wAy0f8ALtT/ACvX/wCNSisANM73APv9/wBNr8kALtL9AC/S/QCTQRMAct//AIpTNACMTSwAjEwvADjI8ADi+P8AQbzgAFHX/wCC4v8AhllFAC/S/gAw0v4AeHJrADHS/gC27f8AMtL+ACfb/gCHVj0AZ4qUAH1sYwA20v4APsHjAIxNLQD+/v4A//7+AEi42wA0y/EAj+X/AIZaQwA5xekAYdr/AIxMKAAu0v8AL9L/ADDS/wBD1f4AeWxkADHS/wDY9v4AWp6wAIJhUQA00v8ANdL/ACvV9wBhkqAAN9L/ADjS/wBq3f8A/f7/AP7+/wD//v8AMNH6AI1NLgCQRRsALdT6AIJgTACLTzEANc7yAEHV/wAu1v0AStX/AP///QCKTS8AeWxdAIxNLwCMUC8AgeP/AFqcrwCLTzIALtP+AC/T/gAw0/4AkUEXACbc/gBZnrIA/v/+AI5IJQD///4ALNX5ADLM8QB5bF4Ab97+AIdVOwAr0/8AMND/APT8/wAx0P8AL9P/AIxMKwBhlqgA+///ADfT/wD8//8A/f//AIxOLgD+//8A////ADDR/QBjj5sAMdH9ADLR/QBz3v8AxvL9ACvX/QCPSikAi04vAC7S+wCPRhwAjU4vAC3R/gAu0f4AL9H+ADDR/gAo2/sAj0snADHR/gB6cWsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAdnZ2Y3V2R1Idc3V2dnZ2dnZ2dnZHewiFhXkeYXZ2dnZ2dlM0ajs7hoY7EwxFc0d2cnwhhAk7Ozs7O4WFdwwbdkgWO4M7DIYmDnoEAzY4WHYuhDsLaDJfYjVlCFlLiQl2c4Y7CUkfin14BV1aXoQ3dnMMhgCBiFZ0Ek4ibmk4IXYkiYaGTYJUf0p/GQ8oeTs8RAmECSw+AX6HQTArVyE7UD8lhoApYBgnGhdVZg0Ghjl2hlxRFT0COgoHbzNtFAlzdnZshhAvTxyGTGRCFAhwdXZ2a4Q7N1uJIDuGhjYRY3Z2dnZnIIYhO4kIhSMxYXZ2dnZhdggjQCpxQ4klRi12dgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=');
        $favicon->setOrganization($westfriesland);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $logo = new Image();
        $logo->setName('West-Friesland Logo');
        $logo->setDescription('West-Friesland VNG');
        $logo->setOrganization($westfriesland);

        $style = new Style();
        $style->setName('West-Friesland');
        $style->setDescription('Huistlijl samenwerkingsverband West-Friesland');
        $style->setCss(':root {--primary: #233A79;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->setOrganization($westfriesland);

        $manager->persist($westfriesland);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Begrafenisplanner
        $id = Uuid::fromString('3f44c00e-d919-4f89-bd4c-b730c9b2620a');
        $application = new Application();
        $application->setName('Begrafenisplanner');
        $application->setDescription('Begrafenisplanner');
        $application->setDomain('westfriesland.commonground.nu');
        $application->setOrganization($westfriesland);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id' => $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setOrganization($westfriesland);
        $configuration->setApplication($application);
        $configuration->setConfiguration(
            [
                'loggedIn' => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'menus', 'id' => 'a8496676-767a-4d1e-beab-be39a7b2c870']),
                'mainMenu' => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'menus', 'id' => '0ff074bc-e6db-43ed-93ae-c027ad452f78']),
                'home'     => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => '097ea88e-beb6-476e-a978-d07650f03d97']),
                'footer1'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'9e4130de-b2d7-481c-8681-87b2a174c8ae']),
                'footer2'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'e16b153e-de8a-4f24-9886-fd3057ae93de']),
                'footer3'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'f78d6861-783f-4441-82c4-2efcf5af677f']),
                'footer4'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'c62eedef-ba28-4a5d-bdea-2eb9ef250b8e']),
            ]
        );
        $manager->persist($configuration);

        $application->setDefaultConfiguration($configuration);
        $manager->persist($application);
        $manager->flush();

        // loggedIn menu
        $id = Uuid::fromString('a8496676-767a-4d1e-beab-be39a7b2c870');
        $menu = new Menu();
        $menu->setName('loggedIn');
        $menu->setDescription('logged in menu');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id' => $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Mijn West-Friesland');
        $menuItem->setDescription('Stages');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/request');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menu->addMenuItem($menuItem);
        $manager->persist($menu);

        // Menu
        $id = Uuid::fromString('0ff074bc-e6db-43ed-93ae-c027ad452f78');
        $menu = new Menu();
        $menu->setName('Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id' => $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('MenuItem naar home page');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menu->addMenuItem($menuItem);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Zelf regelen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menu->addMenuItem($menuItem);
        $manager->persist($menu);
        $manager->flush();

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($westfriesland);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('097ea88e-beb6-476e-a978-d07650f03d97');
        $template = new Template();
        $template->setName('Home');
        $template->setTitle('Home');
        $template->setDescription('De (web) applicatie waarop begravenisen kunnen worden doorgegeven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        $id = Uuid::fromString('9e4130de-b2d7-481c-8681-87b2a174c8ae');
        $template = new Template();
        $template->setName('footer1');
        $template->setDescription('Menu met links naar partners en juridische informatie van West-Friesland');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('e16b153e-de8a-4f24-9886-fd3057ae93de');
        $template = new Template();
        $template->setName('footer2');
        $template->setDescription('Menu met links naar gemeenten in West-Friesland');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('f78d6861-783f-4441-82c4-2efcf5af677f');
        $template = new Template();
        $template->setName('footer3');
        $template->setDescription('Formulier voor de nieuwsbrief van West-Friesland over begraven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('c62eedef-ba28-4a5d-bdea-2eb9ef250b8e');
        $template = new Template();
        $template->setName('footer4');
        $template->setDescription('Contactgegevens van West-Friesland');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        // Dashboard
        $style = new Style();
        $style->setName('Dashboard');
        $style->setDescription('Huistlijl samenwerkingsverband West-Friesland');
        $style->setCss(':root {--primary: #233A79;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;} #docs-nav {background: var(--primary)} #footer {background: var(--primary)}
          .begraaf-card {background: var(--primary); text-align:center; padding: 20px !important; margin-bottom: 75px; }
          .begraaf-card:active .begraaf-card:visited {background var(--primary) !important}
          .header-logo{text-align: left !important; padding: 15px 0 5px 0px} .top-nav-autoresize .nav__link:hover {background: var(--primary)}
          .nav__item a {background: var(--primary)}');

        $style->setfavicon($favicon);
        $style->setOrganization($westfriesland);

        $application->setStyle($style);
        $manager->persist($application);

        $manager->persist($westfriesland);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('76298171-e049-4492-ae7b-1d2fe231aa5f');
        $application = new Application();
        $application->setName('Dashboard');
        $application->setDescription('het Dashboard van de gemeente westfriesland');
        $application->setDomain('db.westfriesland.commonground.nu');
        $application->setOrganization($westfriesland);
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id' => $id]);

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('Dashboard');
        $configuration->setDescription('Dashboard van Zuid-Drecht');
        $configuration->setOrganization($westfriesland);
        $configuration->setApplication($application);
        $manager->persist($configuration);
    }
}
