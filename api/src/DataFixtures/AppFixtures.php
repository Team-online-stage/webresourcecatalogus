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
    	$application->setName();
    	$application->setDescription();
    	$application->setDomain('huwelijksplanner.online');
    	$application->setTemplateEngine('twig');
    	$manager->persist($application);
    	
    	
    	// Getuigen   	
    	$template = New Template;
    	$template->setData();
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
    	$template->setData();
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
    	$template->setData();
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

        $manager->flush();
    }
}
