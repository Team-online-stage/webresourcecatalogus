<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use App\Entity\Style;
use App\Entity\Application;
use App\Entity\Page;
use App\Entity\Slug;
use App\Entity\Template;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

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
        if (strpos($this->params->get('app_domain'), "conduction.online") == false) {
            return false;
        }

    	// Deze organisaties worden ook buiten het wrc gebruikt
    	// Utrecht
    	$id = Uuid::fromString('7c9e5618-37ba-47dc-a628-b1b6fe96d69c');
    	$conduction = new Organization();
        $conduction->setName('Utrecht');
        $conduction->setDescription('Gemeente Utrecht');
        $conduction->setRsin('002220647');
    	//$utrecht->setContact('https://cc.huwelijksplanner.online/organizations/95c3da92-b7d3-4ea0-b6d4-3bc24944e622');
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

        // Home
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

        // Home
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

        // Pages
        $template = new Template();
        $template->setName('Instemming'); // Naam
        $template->setDescription('Pagina waarop instemming kan worden verleend'); // korte beschrijving
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/index.html.twig', 'r'));
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
        $slug->setSlug('assent'); // Dit komt eigenlijk overeen met de route
        $manager->persist($slug);



    }
}