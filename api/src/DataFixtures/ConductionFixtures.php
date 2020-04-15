<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use App\Entity\Organization;
use App\Entity\Style;
use App\Entity\Application;
use App\Entity\Page;
use App\Entity\Slug;
use App\Entity\Template;
use App\Entity\Image;

class ConductionFixtures extends Fixture
{
	private $params;

	public function __construct(ParameterBagInterface $params)
	{
		$this->params = $params;
	}

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if ($this->params->get('app_domain') != "conduction.nl" && strpos($this->params->get('app_domain'), "conduction.nl") == false) {
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
        $conduction= $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

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

        /*
        // Pages
        $template = new Template();
        $template->setName('Home'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/home.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);


        $template = new Template();
        $template->setName('Buzz'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/buzz.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);


        $template = new Template();
        $template->setName('Commonground'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/commonground.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);



        $template = new Template();
        $template->setName('Contact'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/contact.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);



        $template = new Template();
        $template->setName('Idealen'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/idealen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);


        $template = new Template();
        $template->setName('Partners'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/partners.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);

        $template = new Template();
        $template->setName('Projecten'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/projecten.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);


        $template = new Template();
        $template->setName('Team'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/team.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);


        $template = new Template();
        $template->setName('Vacatures'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/vacatures.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);


        $template = new Template();
        $template->setName('Webservice'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/webservice.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);



        $template = new Template();
        $template->setName('Werkwijze'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/werkwijze.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        $page = new Page();
        $page->setName($template->getName());
        $page->setTitle($template->getName());
        $page->setDescription($template->getName());
        $page->setApplication($website);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($website);
        $slug->setName($page->getName());
        $slug->setSlug(''); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);

        $manager->flush();
        */

    }
}
