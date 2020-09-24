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

        $id = Uuid::fromString('da8af35b-afca-455e-a722-6d0052f7367d');
        $headerimg = new Image();
        $headerimg->setName('header image');
        $headerimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Header.png', 'r')));
        $headerimg->setDescription('Stage header');
        $headerimg->setOrganization($organization);
        $manager->persist($headerimg);
        $headerimg->setId($id);
        $manager->persist($headerimg);
        $manager->flush();
        $headerimg = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('62685881-e5a2-4f73-b08f-a155b6dab74c');
        $kladimg = new Image();
        $kladimg->setName('klad image');
        $kladimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Klad.png', 'r')));
        $kladimg->setDescription('stageplatform klad image ');
        $kladimg->setOrganization($organization);
        $manager->persist($kladimg);
        $kladimg->setId($id);
        $manager->persist($kladimg);
        $manager->flush();
        $kladimg = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cdaad46c-f1b3-11ea-adc1-0242ac120002');
        $raketimg = new Image();
        $raketimg->setName('raket image');
        $raketimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Raket-rechts-onder.png', 'r')));
        $raketimg->setDescription('stageplatform raket voor rechts onder ');
        $raketimg->setOrganization($organization);
        $manager->persist($raketimg);
        $raketimg->setId($id);
        $manager->persist($raketimg);
        $manager->flush();
        $raketimg = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('90a7204b-0e11-4bb9-b6ec-98917a1f4efc');
        $student02 = new Image();
        $student02->setName('student02');
        $student02->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_02.png', 'r')));
        $student02->setDescription('stageplatform student02');
        $student02->setOrganization($organization);
        $manager->persist($student02);
        $student02->setId($id);
        $manager->persist($student02);
        $manager->flush();
        $student02 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3b79dd04-f7b7-4a07-9916-f7f59e61b20a');
        $student04 = new Image();
        $student04->setName('student04');
        $student04->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_04.png', 'r')));
        $student04->setDescription('stageplatform student04');
        $student04->setOrganization($organization);
        $manager->persist($student04);
        $student04->setId($id);
        $manager->persist($student04);
        $manager->flush();
        $student04 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e235c391-d735-4aca-bbc4-a6403a185577');
        $student06 = new Image();
        $student06->setName('student06');
        $student06->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_06.png', 'r')));
        $student06->setDescription('stageplatform student06');
        $student06->setOrganization($organization);
        $manager->persist($student06);
        $student06->setId($id);
        $manager->persist($student06);
        $manager->flush();
        $student06 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('726b7a12-584a-476c-b662-c898ec0f1bc3');
        $student08 = new Image();
        $student08->setName('student08');
        $student08->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_08.png', 'r')));
        $student08->setDescription('stageplatform student08');
        $student08->setOrganization($organization);
        $manager->persist($student08);
        $student08->setId($id);
        $manager->persist($student08);
        $manager->flush();
        $student08 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('8398d3d8-0c16-4603-8256-c4c9c85069ea');
        $student10 = new Image();
        $student10->setName('student10');
        $student10->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_10.png', 'r')));
        $student10->setDescription('stageplatform student10');
        $student10->setOrganization($organization);
        $manager->persist($student10);
        $student10->setId($id);
        $manager->persist($student10);
        $manager->flush();
        $student10 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('cda86f0b-079b-41d7-9ed9-8f62b55af998');
        $student12 = new Image();
        $student12->setName('student12');
        $student12->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_12.png', 'r')));
        $student12->setDescription('stageplatform student12');
        $student12->setOrganization($organization);
        $manager->persist($student12);
        $student12->setId($id);
        $manager->persist($student12);
        $manager->flush();
        $student12 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('480dcb31-041c-4dd7-80dc-f7d0e6575ab9');
        $student14 = new Image();
        $student14->setName('student14');
        $student14->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_14.png', 'r')));
        $student14->setDescription('stageplatform student14');
        $student14->setOrganization($organization);
        $manager->persist($student14);
        $student14->setId($id);
        $manager->persist($student14);
        $manager->flush();
        $student14 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('ea236cdd-0147-4c68-9a47-e71c252a2727');
        $student17 = new Image();
        $student17->setName('student17');
        $student17->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Stage/afbeeldingen/Studenten-los_17.png', 'r')));
        $student17->setDescription('stageplatform student17');
        $student17->setOrganization($organization);
        $manager->persist($student17);
        $student17->setId($id);
        $manager->persist($student17);
        $manager->flush();
        $student17 = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        $style = new Style();
        $style->setName('academy');
        $style->setFavicon($favicon);
        $style->setDescription('Huistlijl Gemeente Zuid-Drecht');
        $style->setCss('
               :root {
                       --primary: #263846;
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
                .main {
                       padding-top: 0px;
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
                'mainMenu'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'fccb7e65-2b56-49a2-8720-724f823f2b00']),
                'loggedIn'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'58873338-3ef1-4764-a1a8-72a8787625f4']),
                'home'                  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'d6127f56-c334-4eb7-bade-c70e97631aec']),
                'footer1'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'afa4c1f6-17b7-40a2-b289-57640bb141d9']),
                'footer2'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'ddeb11ba-7205-44ae-bfe9-4bd4fbb9265a']),
                'footer3'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'f668379b-0b93-4cf7-b243-7035e7728466']),
                'footer4'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'0c663ab8-f9d5-42c5-8866-1a51fcf74a12']),
                'headerimg'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'da8af35b-afca-455e-a722-6d0052f7367d']),
                'kladimg'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'62685881-e5a2-4f73-b08f-a155b6dab74c']),
                'raketimg'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'cdaad46c-f1b3-11ea-adc1-0242ac120002']),
                'footer4img'            => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'e49586fb-ec10-4f92-8ad5-f78e323ac104']),
                'student02'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'90a7204b-0e11-4bb9-b6ec-98917a1f4efc']),
                'student04'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'3b79dd04-f7b7-4a07-9916-f7f59e61b20a']),
                'student06'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'e235c391-d735-4aca-bbc4-a6403a185577']),
                'student08'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'726b7a12-584a-476c-b662-c898ec0f1bc3']),
                'student10'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'8398d3d8-0c16-4603-8256-c4c9c85069ea']),
                'student12'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'cda86f0b-079b-41d7-9ed9-8f62b55af998']),
                'student14'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'480dcb31-041c-4dd7-80dc-f7d0e6575ab9']),
                'student17'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'ea236cdd-0147-4c68-9a47-e71c252a2727']),
                'googleTagId'           => 'G-2PYCJ13YC4',
                'userPage'              => 'me',
                'login'                 => ['facebook'=>true, 'github'=>true],
                'header'                => false,
                'stickyMenu'            => true,
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
        $template->setName('footer1');
        $template->setDescription('footer1');
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
        $template->setName('footer1');
        $template->setDescription('footer1');
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
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
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
