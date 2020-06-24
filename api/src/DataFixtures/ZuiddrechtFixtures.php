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
        $organization->setRsin('1234');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('Zuid-Drecht Favicon');
        $favicon->setBase64("data:image/svg+xml;base64,PHN2ZyBpZD0iw5HDq8Ouw6lfMSIgZGF0YS1uYW1lPSLDkcOrw67DqSAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MzkuNTcgMTA5OC44OSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMDA7fS5jbHMtMntmaWxsOiMzNjY5YTU7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT56dWlkIERyZWNodCBOb3BheW9mZjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTc2LDk2Ny4xMWMtNTYsNDEuMzktMTAxLjQzLDY2LjA1LTExMSw3MS4xMWE0LDQsMCwwLDEtMy43MiwwYy0yNS41Ny0xMy41LTMwNy40OC0xNjctMzYxLjM3LTQwNmE0LDQsMCwwLDEsNy4zOC0yLjgxYzM4LjU0LDY4LjkzLDEyNS4zNywxMTkuMjYsMTg3LjUxLDE1Mi42OSw1Mi41LDI4LjIzLDExMy42Miw1MC4yMSwxNjguMzQsODAuMzZDNTA4LjIyLDg4Ny4yOSw1NDksOTE3LjY5LDU3Nyw5NjEuNzVBNCw0LDAsMCwxLDU3Niw5NjcuMTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNODM0LjcxLDIxNS44NFYxMDEuNjVhOC45LDguOSwwLDAsMC04LjktOC45MWgtMjczQTE0LjU5LDE0LjU5LDAsMCwwLDUzOS40MywxMDNsLTE5LDcwLjI4YTE0LjU4LDE0LjU4LDAsMCwxLTEzLjM1LDEwLjIxSDM4M1YxNDcuMTJjMzYuODQtMS4zNCw2Mi40Mi03LjQ1LDgwLjE2LTE1LjEsMjkuNDktMTIuNzQsMzcuMzUtMjkuNzgsMzkuMzYtMzYuNDRhMi4yMiwyLjIyLDAsMCwwLTIuMTMtMi44NEgzMzQuNjFjLTMzLjg4LDAtNjcuOTEsOS4yLTg2LjA4LDQwLjEtMTkuMzgsMzIuOTQtMTguMjQsNzguMDctMTYuNDksMTE0Ljg5LDAsMC01MC02Ni4yMi00MC43Ni0xNDguODdhNS41MSw1LjUxLDAsMCwwLTUuNDgtNi4xMkgxMDAuMzJhOC43OSw4Ljc5LDAsMCwwLTguNzgsOC43OVYxMjRjNC44Niw3OS4yNiw0OS4xNCwyODguNTcsMzcxLjU4LDM4NS40QzczNSw1OTEuMDYsNzc1LjQyLDcxNi4zLDc4My4zMiw3MzguMjRhMS4zOCwxLjM4LDAsMCwwLDIuNTMuMTdjNzUuMy0xNDMuOS04MS40OS0yNDcuNTItODEuNDktMjQ3LjUyLDMxLjMzLDAsNzkuMjMsMTcuOTQsMTE4LDM5Ljc5YTguMjgsOC4yOCwwLDAsMCwxMi4zNy03LjIxVjM2My44M2ExNC42LDE0LjYsMCwwLDAtMTguMTUtMTQuMTdjLTEzLjUsMy4zOS0zMCw2LjY4LTMyLjg3LDcuMjMtMzkuNDYsNy43Ny04NC43NSwxMS4xNS0xMjItOC43M3MtNDcuMjYtNjYuMjctMTguMzMtOTguMjNjMjUuMy0yOCw2NS41My0zNy41LDEwMi4yOS0zNSwyMy41NiwxLjYyLDU1LjE4LDcuNTksNzMuNzEsMTIuNjNBMTIuMTYsMTIuMTYsMCwwLDAsODM0LjcxLDIxNS44NFoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik02NTQuODcsOTAxLjVhNCw0LDAsMCwxLTYtLjExYy0xMy41Ni0xNi4yNS03NS40Ni04Ni0xODUuNzMtMTQ2LjQyQTc1Ni40NCw3NTYuNDQsMCwwLDAsMzgzLDcxN2MtMTczLjUzLTcwLjE3LTI4Mi42OS0xNDMuMy0yOTEuNDItMzM4LjF2LTYuMjJhNCw0LDAsMCwxLDcuMjEtMi4zNGM2My42MSw4NywxNDQuNjksMTM3LjksMjQzLjE2LDE4Ni43Nyw0MC4yOCwyMCw4MS4xNywzNi4zMiwxMjEuMjEsNTMuMjUsNjYuMTUsMjgsMTMwLDU3LjU0LDE4NC43MywxMDcuOCwxNi4xOCwxNC44NSwyOS4wOSwyOS4xNSwzNi44MSw1MEM2OTUuNzUsNzk4LjEzLDcwMi41NSw4NDkuMTcsNjU0Ljg3LDkwMS41WiIvPjwvc3ZnPg==");
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
         var(--secondary2)) !important;}

        .header-logo a:before {
        background: lightgray url("data:image/svg+xml;base64,PHN2ZyBpZD0iw5HDq8Ouw6lfMSIgZGF0YS1uYW1lPSLDkcOrw67DqSAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MzkuNTcgMTA5OC44OSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMDA7fS5jbHMtMntmaWxsOiMzNjY5YTU7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT56dWlkIERyZWNodCBOb3BheW9mZjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTc2LDk2Ny4xMWMtNTYsNDEuMzktMTAxLjQzLDY2LjA1LTExMSw3MS4xMWE0LDQsMCwwLDEtMy43MiwwYy0yNS41Ny0xMy41LTMwNy40OC0xNjctMzYxLjM3LTQwNmE0LDQsMCwwLDEsNy4zOC0yLjgxYzM4LjU0LDY4LjkzLDEyNS4zNywxMTkuMjYsMTg3LjUxLDE1Mi42OSw1Mi41LDI4LjIzLDExMy42Miw1MC4yMSwxNjguMzQsODAuMzZDNTA4LjIyLDg4Ny4yOSw1NDksOTE3LjY5LDU3Nyw5NjEuNzVBNCw0LDAsMCwxLDU3Niw5NjcuMTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNODM0LjcxLDIxNS44NFYxMDEuNjVhOC45LDguOSwwLDAsMC04LjktOC45MWgtMjczQTE0LjU5LDE0LjU5LDAsMCwwLDUzOS40MywxMDNsLTE5LDcwLjI4YTE0LjU4LDE0LjU4LDAsMCwxLTEzLjM1LDEwLjIxSDM4M1YxNDcuMTJjMzYuODQtMS4zNCw2Mi40Mi03LjQ1LDgwLjE2LTE1LjEsMjkuNDktMTIuNzQsMzcuMzUtMjkuNzgsMzkuMzYtMzYuNDRhMi4yMiwyLjIyLDAsMCwwLTIuMTMtMi44NEgzMzQuNjFjLTMzLjg4LDAtNjcuOTEsOS4yLTg2LjA4LDQwLjEtMTkuMzgsMzIuOTQtMTguMjQsNzguMDctMTYuNDksMTE0Ljg5LDAsMC01MC02Ni4yMi00MC43Ni0xNDguODdhNS41MSw1LjUxLDAsMCwwLTUuNDgtNi4xMkgxMDAuMzJhOC43OSw4Ljc5LDAsMCwwLTguNzgsOC43OVYxMjRjNC44Niw3OS4yNiw0OS4xNCwyODguNTcsMzcxLjU4LDM4NS40QzczNSw1OTEuMDYsNzc1LjQyLDcxNi4zLDc4My4zMiw3MzguMjRhMS4zOCwxLjM4LDAsMCwwLDIuNTMuMTdjNzUuMy0xNDMuOS04MS40OS0yNDcuNTItODEuNDktMjQ3LjUyLDMxLjMzLDAsNzkuMjMsMTcuOTQsMTE4LDM5Ljc5YTguMjgsOC4yOCwwLDAsMCwxMi4zNy03LjIxVjM2My44M2ExNC42LDE0LjYsMCwwLDAtMTguMTUtMTQuMTdjLTEzLjUsMy4zOS0zMCw2LjY4LTMyLjg3LDcuMjMtMzkuNDYsNy43Ny04NC43NSwxMS4xNS0xMjItOC43M3MtNDcuMjYtNjYuMjctMTguMzMtOTguMjNjMjUuMy0yOCw2NS41My0zNy41LDEwMi4yOS0zNSwyMy41NiwxLjYyLDU1LjE4LDcuNTksNzMuNzEsMTIuNjNBMTIuMTYsMTIuMTYsMCwwLDAsODM0LjcxLDIxNS44NFoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik02NTQuODcsOTAxLjVhNCw0LDAsMCwxLTYtLjExYy0xMy41Ni0xNi4yNS03NS40Ni04Ni0xODUuNzMtMTQ2LjQyQTc1Ni40NCw3NTYuNDQsMCwwLDAsMzgzLDcxN2MtMTczLjUzLTcwLjE3LTI4Mi42OS0xNDMuMy0yOTEuNDItMzM4LjF2LTYuMjJhNCw0LDAsMCwxLDcuMjEtMi4zNGM2My42MSw4NywxNDQuNjksMTM3LjksMjQzLjE2LDE4Ni43Nyw0MC4yOCwyMCw4MS4xNywzNi4zMiwxMjEuMjEsNTMuMjUsNjYuMTUsMjgsMTMwLDU3LjU0LDE4NC43MywxMDcuOCwxNi4xOCwxNC44NSwyOS4wOSwyOS4xNSwzNi44MSw1MEM2OTUuNzUsNzk4LjEzLDcwMi41NSw4NDkuMTcsNjU0Ljg3LDkwMS41WiIvPjwvc3ZnPg==") no-repeat bottom;
        background-size: 100%;
        content: ;
        left:  0;
        position: absolute;
        top: 0;}');

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
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Website
        $id = Uuid::fromString('1ef30b69-6b28-4fbd-a0cd-83d6ff3c505e');
        $application = new Application();
        $application->setName('Zuid-Drecht');
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
                'footer4'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/templates/4bc966b6-e310-4bce-b459-a7cf65651ce0"),
                'nieuws'=> $this->commonGroundService->cleanUrl("{$this->commonGroundService->getComponent('wrc')['location']}/template_groups/5c59f238-1ce3-4c8d-8107-4bd8e2134648"),]
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
        $menuItem->setName('Zelf regelen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/Home');
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
        $menuItem->setName('Ondernemers');
        $menuItem->setDescription('Lijst van ondernemers');
        $menuItem->setOrder(3);
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
        $template->setName('pi event');
        $template->setDescription('pi event is van start');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/pi-event.html.twig', 'r'));
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
        $slug->setName('pi-event');
        $slug->setSlug('pi-event');
        $manager->persist($slug);

        $id = Uuid::fromString('67b1e403-4436-4cd9-a328-ce99e05511a1');
        $template = new Template();
        $template->setName('huwelijksplanner');
        $template->setDescription('utrecht lanceert huwelijksplanner');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/huwelijksplanner.html.twig', 'r'));
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
        $slug->setName('huwelijksplanner');
        $slug->setSlug('huwelijksplanner');
        $manager->persist($slug);

        $id = Uuid::fromString('90035899-fd96-4998-9d38-db7b0f5940f9');
        $template = new Template();
        $template->setName('corona');
        $template->setDescription('Dit kan Nederland leren van corona-uitbraken Duitsland');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/corona.html.twig', 'r'));
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
        $slug->setName('corona');
        $slug->setSlug('corona');
        $manager->persist($slug);

        $id = Uuid::fromString('12f475a7-151c-48b6-8b02-0e0dfcfc78d9');
        $template = new Template();
        $template->setName('groene stroom');
        $template->setDescription('zuid-drecht gaat over op groene stroom');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/groene-stroom.html.twig', 'r'));
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
        $slug->setName('groene-stroom');
        $slug->setSlug('groene-stroom');
        $manager->persist($slug);

        $id = Uuid::fromString('272a5076-dfb0-4adf-b5ca-d3525e7a31bf');
        $template = new Template();
        $template->setName('Woninginbraak gehalveerd');
        $template->setDescription('Woninginbraak gehalveerd in de gemeente zuid-drecht');
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
        $template->setDescription('Zuid-drecht is uitgeroepen tot beste gemeente van 2020');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/beste-gemeente.html.twig', 'r'));
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
        $slug->setName('beste-gemeente');
        $slug->setSlug('beste-gemeente');
        $manager->persist($slug);



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
