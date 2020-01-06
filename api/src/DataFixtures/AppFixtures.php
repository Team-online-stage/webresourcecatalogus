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
    	$application->setName('MijnApp');
    	$application->setDescription('MijnApp');
    	$application->setDomain('huwelijksplanner.online');
    	$manager->persist($application);
    	
    	// Home
    	$id = Uuid::fromString('536bfb73-63a5-4719-b535-d835607b88b2');
    	$application = New Application;
    	$application->setName('Huwelijksplanner');
    	$application->setDescription('Huwelijksplanner');
    	$application->setDomain('huwelijksplanner.online');
    	$manager->persist($application);
    	$application->setId($id);
    	$manager->persist($application);
    	$manager->flush();
    	$application= $manager->getRepository('App:Application')->findOneBy(array('id'=> $id));
    	
    	// Getuigen
    	$id = Uuid::fromString('20219e4b-4dd0-4dc9-8768-3ecb33cf3d78');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/trouwens.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Trouwen');
    	$page->setDescription('trouwen');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('trouwen');
    	$manager->persist($page);
    	
    	// Getuigen
    	$id = Uuid::fromString('da78b8bb-16bf-449c-96e3-3615e9e8e2af');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/getuigen-kiezen.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Getuigen');
    	$page->setDescription('Over getuigen');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('getuigen-kiezen');
    	$manager->persist($page);
    	
    	// Getuigen
    	$id = Uuid::fromString('75de9a49-e89a-4a9d-8efc-135be48e98ac');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/getuigen.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	    	
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
    	$id = Uuid::fromString('648e2ce2-e157-42ac-8bac-1fa59032bbfc');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/naamsgebruik.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
    	$id = Uuid::fromString('ea817100-a03d-4fd3-ae7b-3d39b9c577f9');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/melding.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
    	$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/naamsgebruik.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
    	$id = Uuid::fromString('3450ae40-3c07-4e09-83c2-f0c54e3b574a');
    	$template = New Template;
    	$template->setContent('Ambtenaren');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
    	$id = Uuid::fromString('0bd283c4-771c-4ee0-b87f-8ce40dabe6a1');
    	$template = New Template;
    	$template->setContent('Locaties');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
    	$id = Uuid::fromString('50409369-6f28-4f9e-b074-2fa638d1b25a');
    	$template = New Template;
    	$template->setContent('Extras');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
    	$id = Uuid::fromString('5e54949c-b98e-4239-8037-49e403ca135f');
    	$template = New Template;
    	$template->setContent('Partner');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
    	$id = Uuid::fromString('99ffba08-a698-49a9-8006-232a0abdb4a2');
    	$template = New Template;
    	$template->setContent('Checklist');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
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
