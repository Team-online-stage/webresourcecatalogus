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

class PinkFixtures extends Fixture
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
            $this->params->get('app_domain') != 'mijncluster.nl' && strpos($this->params->get('app_domain'), 'mijncluster.nl') == false
        ) {
            return false;
        }

        // Pink Roccade
        $id = Uuid::fromString('cc935415-a674-4235-b99d-0c7bfce5c7aa');
        $organisation = new Organization();
        $organisation->setName('Pink Roccade');
        $organisation->setDescription('Pink Roccade');
        $organisation->setRsin('1234');
        $manager->persist($organisation);
        $organisation->setId($id);
        $manager->persist($organisation);
        $manager->flush();
        $organisation = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('6635f156-9d88-46c2-976e-0bc31043c4b2');
        $favicon = new Image();
        $favicon->setName('Pink Roccade');
        $favicon->setDescription('Pink Roccade');
        $favicon->setOrganization($organisation);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Pink Roccade Logo');
        $logo->setDescription('Pink Roccade');
        $logo->setOrganization($organisation);

        $style = new Style();
        $style->setName('Pink Roccade');
        $style->setDescription('Huistlijl Pink Roccade');
        $style->setCss(':root {--primary: #E2007A;--primary2: white;--secondary: #446686;--secondary2: #FFC926;}
.main-title {color: var(--primary2) !important;}

.logo-header {background: var(--primary);}

.navbar-header {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;}

.background--donkerblauw {
    background-color: #E2007A;
    color: #fff;
}

.main-header{
   background-color: #E2007A;
}

.panel-header{
   background-color: #446686;
}
');

        $style->setfavicon($favicon);
        $style->addOrganization($organisation);

        $manager->persist($organisation);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Verhuis service
        $id = Uuid::fromString('4a9a0b39-ba6c-4048-bdf4-3c34eb560e2d');
        $application = new Application();
        $application->setName('Verhuisservice');
        $application->setDescription('Voorbeeld verhuisservice voor Pink Roccade');
        $application->setDomain('mijncluster.nl');
        $application->setOrganization($organisation);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setOrganization($organisation);
        $configuration->setApplication($application);
        $configuration->setConfiguration([
            'mainMenu'=> "{$this->commonGroundService->getComponent('wrc')['location']}/menus/7bd10d57-e1bb-48dd-81a2-fbf91ab710a0",
            'home'    => "{$this->commonGroundService->getComponent('wrc')['location']}/templates/1cd04580-381e-4246-aed3-3c890b91e3f6",
        ]);
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('7bd10d57-e1bb-48dd-81a2-fbf91ab710a0');
        $menu = new Menu();
        $menu->setName('Main Menu');
        $menu->setDescription('Het hoofd menu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Processen');
        $menuItem->setDescription('Het hoofd menu van deze website');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Verzoeken');
        $menuItem->setDescription('Het hoofd menu van deze website');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/request');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Inloggen');
        $menuItem->setDescription('Het hoofd menu van deze website');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('https://ds.dev.mijncluster.nl/?responceUrl=https://pan.dev.mijncluster.nl');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organisation);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('1cd04580-381e-4246-aed3-3c890b91e3f6');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('De (web) applicatie waarop begravenisen kunnen worden doorgegeven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/index.html.twig', 'r'));
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
