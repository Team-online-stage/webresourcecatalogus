<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Slug;
use App\Entity\Style;
use App\Entity\Template;
use App\Entity\TemplateGroup;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class StageFixtures extends Fixture implements DependentFixtureInterface
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

    public function getDependencies()
    {
        return [
            ConductionFixtures::class,
            ZuiddrechtFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false &&
            $this->params->get('app_domain') != 'conduction.academy' && strpos($this->params->get('app_domain'), 'conduction.academy') == false
        ) {
            return false;
        }

        $organization = $this->getReference(ZuiddrechtFixtures::ORGANIZATION_ZUIDDRECHT);

        $favicon = new Image();
        $favicon->setName('CheckIN Favicon');
        $favicon->setDescription('CheckIN Favicon');
        $favicon->setBase64('data:image/svg+xml;base64,PHN2ZyBpZD0iw5HDq8Ouw6lfMSIgZGF0YS1uYW1lPSLDkcOrw67DqSAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MzkuNTcgMTA5OC44OSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMDA7fS5jbHMtMntmaWxsOiMzNjY5YTU7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT56dWlkIERyZWNodCBOb3BheW9mZjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTc2LDk2Ny4xMWMtNTYsNDEuMzktMTAxLjQzLDY2LjA1LTExMSw3MS4xMWE0LDQsMCwwLDEtMy43MiwwYy0yNS41Ny0xMy41LTMwNy40OC0xNjctMzYxLjM3LTQwNmE0LDQsMCwwLDEsNy4zOC0yLjgxYzM4LjU0LDY4LjkzLDEyNS4zNywxMTkuMjYsMTg3LjUxLDE1Mi42OSw1Mi41LDI4LjIzLDExMy42Miw1MC4yMSwxNjguMzQsODAuMzZDNTA4LjIyLDg4Ny4yOSw1NDksOTE3LjY5LDU3Nyw5NjEuNzVBNCw0LDAsMCwxLDU3Niw5NjcuMTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNODM0LjcxLDIxNS44NFYxMDEuNjVhOC45LDguOSwwLDAsMC04LjktOC45MWgtMjczQTE0LjU5LDE0LjU5LDAsMCwwLDUzOS40MywxMDNsLTE5LDcwLjI4YTE0LjU4LDE0LjU4LDAsMCwxLTEzLjM1LDEwLjIxSDM4M1YxNDcuMTJjMzYuODQtMS4zNCw2Mi40Mi03LjQ1LDgwLjE2LTE1LjEsMjkuNDktMTIuNzQsMzcuMzUtMjkuNzgsMzkuMzYtMzYuNDRhMi4yMiwyLjIyLDAsMCwwLTIuMTMtMi44NEgzMzQuNjFjLTMzLjg4LDAtNjcuOTEsOS4yLTg2LjA4LDQwLjEtMTkuMzgsMzIuOTQtMTguMjQsNzguMDctMTYuNDksMTE0Ljg5LDAsMC01MC02Ni4yMi00MC43Ni0xNDguODdhNS41MSw1LjUxLDAsMCwwLTUuNDgtNi4xMkgxMDAuMzJhOC43OSw4Ljc5LDAsMCwwLTguNzgsOC43OVYxMjRjNC44Niw3OS4yNiw0OS4xNCwyODguNTcsMzcxLjU4LDM4NS40QzczNSw1OTEuMDYsNzc1LjQyLDcxNi4zLDc4My4zMiw3MzguMjRhMS4zOCwxLjM4LDAsMCwwLDIuNTMuMTdjNzUuMy0xNDMuOS04MS40OS0yNDcuNTItODEuNDktMjQ3LjUyLDMxLjMzLDAsNzkuMjMsMTcuOTQsMTE4LDM5Ljc5YTguMjgsOC4yOCwwLDAsMCwxMi4zNy03LjIxVjM2My44M2ExNC42LDE0LjYsMCwwLDAtMTguMTUtMTQuMTdjLTEzLjUsMy4zOS0zMCw2LjY4LTMyLjg3LDcuMjMtMzkuNDYsNy43Ny04NC43NSwxMS4xNS0xMjItOC43M3MtNDcuMjYtNjYuMjctMTguMzMtOTguMjNjMjUuMy0yOCw2NS41My0zNy41LDEwMi4yOS0zNSwyMy41NiwxLjYyLDU1LjE4LDcuNTksNzMuNzEsMTIuNjNBMTIuMTYsMTIuMTYsMCwwLDAsODM0LjcxLDIxNS44NFoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik02NTQuODcsOTAxLjVhNCw0LDAsMCwxLTYtLjExYy0xMy41Ni0xNi4yNS03NS40Ni04Ni0xODUuNzMtMTQ2LjQyQTc1Ni40NCw3NTYuNDQsMCwwLDAsMzgzLDcxN2MtMTczLjUzLTcwLjE3LTI4Mi42OS0xNDMuMy0yOTEuNDItMzM4LjF2LTYuMjJhNCw0LDAsMCwxLDcuMjEtMi4zNGM2My42MSw4NywxNDQuNjksMTM3LjksMjQzLjE2LDE4Ni43Nyw0MC4yOCwyMCw4MS4xNywzNi4zMiwxMjEuMjEsNTMuMjUsNjYuMTUsMjgsMTMwLDU3LjU0LDE4NC43MywxMDcuOCwxNi4xOCwxNC44NSwyOS4wOSwyOS4xNSwzNi44MSw1MEM2OTUuNzUsNzk4LjEzLDcwMi41NSw4NDkuMTcsNjU0Ljg3LDkwMS41WiIvPjwvc3ZnPg==');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

        $style = new Style();
        $style->setName('academy');
        $style->setFavicon($favicon);
        $style->setDescription('Huistlijl Gemeente Zuid-Drecht');
        $style->setCss('
               :root {
                       --primary:  #406377;
                       --primary-color: white;
                       --secondary: #cce0f1;
                       --secondary-color: #2b2b2b;
                       --menu: #01689b;
                       --menu-over: #3669A5;
                       --menu-color: white;
                       --menu-height: 100px;
                       --footer: #406377;
                       --footer-color: white;
               }
               .nav-position {
                       width: 100%;
                       display: flex;
                       justify-content: flex-end;
                       order: 2;
               }

                .studentenimg {
                       position: absolute;
                       float: left;
                       height: 230px;
                       margin-top: -60px;
                       margin-left: -30px;
                }

                .graycards {
                       background-color: lightgray;
                       height: 125px;
                       position: relative;
                       margin-bottom: 60px;
                }

                .list--card-small {
                       margin-left: 20px;
                       margin-top:20px;
                }

                .bluebox {
                       background-color: #263846;
                       height:250px;
                }

                .blueboxxl{
                       background-color: #263846;
                       height:465px;
                }

                .studenthome {
                       position: absolute;
                       z-index: 1;
                       top: -30%;
                       height: 150%;
                }

                .about {
                       color: black;
                       text-align: justify;
                }

                .head {
                       position: reltive;
                }

                #headtext {
                       position: absolute;
                       top: 10%;
                       right: 10%;
                       color: #406377;
                       font-size: 45px;
                }

                #headimg {
                       height: 100%;
                       width: 100%;
                       margin-top: -20px;
                       margin-bottom: -10px;
                }

                .description {
                       text-align: center;
                       width: 50%;
                }

                @media only screen and (max-width: 768px) {
                    .studenthome{
                           display: none;
                    }

                    .about {
                           text-align: initial;
                           width: 200%;
                    }

                    .description {
                           width: initial;
                           text-align: initial;
                    }

                    #headtext {
                           position: absolute;
                           top: -6%;
                           right: 7%;
                           font-size: 20px;
                    }
                }
               ');

        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $configuration = new Configuration();
        $configuration->setName('conduction.academy configuration');
        $configuration->setDescription('De configuratie van de stage applicatie');
        $configuration->setOrganization($organization);
        $configuration->setConfiguration(
            [
                'mainMenu'    => 'fccb7e65-2b56-49a2-8720-724f823f2b00',
                'loggedIn'    => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'menus', 'id' => '58873338-3ef1-4764-a1a8-72a8787625f4']),
                'home'        => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => 'd6127f56-c334-4eb7-bade-c70e97631aec']),
                'footer1'     => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => 'afa4c1f6-17b7-40a2-b289-57640bb141d9']),
                'footer2'     => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => 'ddeb11ba-7205-44ae-bfe9-4bd4fbb9265a']),
                'footer3'     => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => 'f668379b-0b93-4cf7-b243-7035e7728466']),
                'footer4'     => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => '0c663ab8-f9d5-42c5-8866-1a51fcf74a12']),
                'googleTagId' => 'G-2PYCJ13YC4',
                'userPage'    => 'me',
                'login'       => ['facebook' => true, 'github' => true],
                'header'      => false,
                'stickyMenu'  => true,
            ]
        );
        $manager->persist($configuration);

        $id = Uuid::fromString('5265828b-85fb-4ad5-acd5-ade4da3fc593');
        $application = new Application();
        $application->setName('academy stage');
        $application->setDescription('Website voor academy');
        $application->setDomain('conduction.academy');
        $application->setStyle($style);
        $application->setOrganization($organization);
        $application->setDefaultConfiguration($configuration);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id' => $id]);

        // loggedIn menu
        $id = Uuid::fromString('58873338-3ef1-4764-a1a8-72a8787625f4');
        $menu = new Menu();
        $menu->setName('loggedIn');
        $menu->setDescription('logged in menu');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id' => $id]);

        // Menu
        $id = Uuid::fromString('fccb7e65-2b56-49a2-8720-724f823f2b00');
        $menu = new Menu();
        $menu->setName('Stage Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id' => $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('Homepagina');
        $menuItem->setOrder(0);
        $menuItem->setType('slug');
        $menuItem->setHref('/home');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Studenten');
        $menuItem->setDescription('Studenten pagina');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/studenten');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Bedrijven/Organisaties');
        $menuItem->setDescription('Bedrijven pagina');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/bedrijven');
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
        $id = Uuid::fromString('d6127f56-c334-4eb7-bade-c70e97631aec');
        $template = new Template();
        $template->setName('Academy Home');
        $template->setDescription('Homepage voor Conduction Academy');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);
        $manager->flush();

        //bedrijfs pagina
        $id = Uuid::fromString('9243d64e-ee93-11ea-adc1-0242ac120002');
        $template = new Template();
        $template->setName('bedrijvenpagina');
        $template->setDescription('stage pagina voor bedrijven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/bedrijf.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('bedrijven');
        $slug->setSlug('bedrijven');
        $manager->persist($slug);
        $manager->flush();

        //studenten pagina
        $id = Uuid::fromString('a4a9a984-d83e-44ac-b27d-c77cd74b0d21');
        $template = new Template();
        $template->setName('Studenten');
        $template->setDescription('Studenten pagina');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/studenten.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('studenten');
        $slug->setSlug('studenten');
        $manager->persist($slug);
        $manager->flush();

        //doelen pagina
        $id = Uuid::fromString('a8979821-eb43-4a10-9290-00d832bec5c5');
        $template = new Template();
        $template->setName('Doelen');
        $template->setDescription('Doelen pagina');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/doelen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('doelen');
        $slug->setSlug('doelen');
        $manager->persist($slug);
        $manager->flush();

        //cursussen pagina
        $id = Uuid::fromString('45c5ef6a-7431-4a5a-ab9c-0154ce5fc53b');
        $template = new Template();
        $template->setName('Cursussen');
        $template->setDescription('Cursussen pagina');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/cursussen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('cursussen');
        $slug->setSlug('cursussen');
        $manager->persist($slug);
        $manager->flush();

        //stages pagina
        $id = Uuid::fromString('a2ce01ee-3f41-49a7-8005-35ed033c2127');
        $template = new Template();
        $template->setName('Stages');
        $template->setDescription('Stages pagina');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/stages.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('stages');
        $slug->setSlug('stages');
        $manager->persist($slug);
        $manager->flush();

        //footer1
        $id = Uuid::fromString('afa4c1f6-17b7-40a2-b289-57640bb141d9');
        $template = new Template();
        $template->setName('footer1');
        $template->setDescription('footer1');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        //footer2
        $id = Uuid::fromString('ddeb11ba-7205-44ae-bfe9-4bd4fbb9265a');
        $template = new Template();
        $template->setName('footer2');
        $template->setDescription('footer2');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        //footer3
        $id = Uuid::fromString('f668379b-0b93-4cf7-b243-7035e7728466');
        $template = new Template();
        $template->setName('footer3');
        $template->setDescription('footer3');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        //footer4
        $id = Uuid::fromString('0c663ab8-f9d5-42c5-8866-1a51fcf74a12');
        $template = new Template();
        $template->setName('footer4');
        $template->setDescription('footer4');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        //profiel aanmaaken
        $id = Uuid::fromString('c71569c8-7f11-4e18-a85d-823bc207125b');
        $template = new Template();
        $template->setName('AcademyProfile');
        $template->setDescription('pagina voor aanmaken van profielen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Stage/signUp.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('aanmelden');
        $slug->setSlug('aanmelden');
        $manager->persist($slug);
        $manager->flush();
    }
}
