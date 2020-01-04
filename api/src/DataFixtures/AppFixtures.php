<?php

namespace App\DataFixtures;

use Ramsey\Uuid\Uuid;

use App\Entity\Application;
use App\Entity\Slug;
use App\Entity\Page;
use App\Entity\Template;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	
    	// Home
    	$application = New Application;
    	$application->setName('Huwelijksplanner');
    	$application->setDescription('Huwelijksplanner');
    	$application->setDomain('huwelijksplanner.online');
    	$manager->persist($application);
    	    	
    	// Getuigen   	
    	$template = New Template;
    	$template->setData('test');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	    	
    	$page = New Page;
    	$page->setTitle('Getuigen');
    	$page->setDescription('Over getuigen');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);    	
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('getuigen');
    	$manager->persist($page);
    	
    	// Naamsgerbuik
    	$template = New Template;
    	$template->setData('test');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Naamsgebruik');
    	$page->setDescription('Over naamsgebruik');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('naamsgebruik');
    	$manager->persist($page);    	
    	
    	// Melding
    	$template = New Template;
    	$template->setData('test');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Melding');
    	$page->setDescription('Over melding');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('melding');
    	$manager->persist($page);
    	    	
    	// Ceremonie
    	$template = New Template;
    	$template->setData('Ceremonie');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Ceremonie');
    	$page->setDescription('Ceremonie');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('ceremonie');
    	$manager->persist($page);
    	
    	// Ambtenaren
    	$template = New Template;
    	$template->setData('Ambtenaren');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Ambtenaren');
    	$page->setDescription('Ambtenaren');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('ambtenaar');
    	$manager->persist($page);
    	
    	// Locatie
    	$template = New Template;
    	$template->setData('Locaties');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Locatie');
    	$page->setDescription('Locaties');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('locaties');
    	$manager->persist($page);
    	
    	// Extras
    	$template = New Template;
    	$template->setData('Extras');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Extras');
    	$page->setDescription('Extras');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('extras');
    	$manager->persist($page);
    	
    	// Partner
    	$template = New Template;
    	$template->setData('Partner');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Partner');
    	$page->setDescription('Partner');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('partner');
    	$manager->persist($page);
    	
    	// Checklist
    	$template = New Template;
    	$template->setData('Checklist');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	
    	$page = New Page;
    	$page->setTitle('Checklist');
    	$page->setDescription('Checklist');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('checklist');
    	$manager->persist($page);

        $manager->flush();
    }
}
