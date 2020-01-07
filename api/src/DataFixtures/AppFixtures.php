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
    	
    	
    	// Berichte
    	$id = Uuid::fromString('b93e6cdf-ed0c-49e7-9975-e6b31f3ebed2');
    	$template = New Template;
    	$template->setContent('Wij hebben uw verzoek ontvangen');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	
    	$id = Uuid::fromString('2d56603e-65b3-4b17-81f7-d88ac8bb4e7f');
    	$template = New Template;
    	$template->setContent('U bent uitgenodigd als {{ role }}, klik op deze link om te bevestigen');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	
    	$id = Uuid::fromString('a36433e4-3c9b-4df5-bf85-1a80bd2ae2ce');
    	$template = New Template;
    	$template->setContent('Er is een aanvraag voor u als trouw ambtenaar, kijk op uw dashboard om deze te acepteren');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	
    	$id = Uuid::fromString('88fefee9-474c-4713-a55c-0ca460882d8d');
    	$template = New Template;
    	$template->setContent('Er is een boeking voor uw locaties, kijk op uw dashboard om deze te acepteren');
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	
    	// Trouwen (ofwel home)
    	$id = Uuid::fromString('20219e4b-4dd0-4dc9-8768-3ecb33cf3d78');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/trouwen.html.twig', 'r'));
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
    	
    	// flow
    	$id = Uuid::fromString('ba71c65e-7a82-449e-af15-947613ca6caa');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/checklist.html.twig', 'r'));
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
    	
    	// flow
    	$id = Uuid::fromString('cb0ada5b-185a-4c64-af20-9a21ac4deb3b');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/flow.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Flow');
    	$page->setDescription('Flow');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('flow');
    	$manager->persist($page);
    	
    	// requests
    	$id = Uuid::fromString('1855950c-e4b6-4a11-bfc7-5a2af7101b68');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/requests.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Requests');
    	$page->setDescription('Requests');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('requests');
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
    	
    	// Plechtigheid    	
    	$id = Uuid::fromString('013276cc-1483-46b4-ad5b-1cba5acf6d9f');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/plechtigheid.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Plechtigheid');
    	$page->setDescription('Plechtigheid');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('plechtigheid');
    	$manager->persist($page);
    	
    	// Ceremonie
    	$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/ceremonies.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Ceremonies');
    	$page->setDescription('Ceremonies');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('ceremonies');
    	$manager->persist($page);
    	    	
    	// Partners
    	//$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/partners.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	//$manager->persist($template);
    	//$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	//$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Partners');
    	$page->setDescription('Partners');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('partners');
    	$manager->persist($page);
    	
    	// Datum
    	//$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/datum.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	//$manager->persist($template);
    	//$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	//$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Datum');
    	$page->setDescription('Datum');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('datum');
    	$manager->persist($page);
    	
    	// Betalen
    	//$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/betalen.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	//$manager->persist($template);
    	//$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	//$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('betalen');
    	$page->setDescription('betalen');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('betalen');
    	$manager->persist($page);
    	
    	// Ambtenaren
    	$id = Uuid::fromString('28268026-6f82-4b19-8dc7-a325edfeca82');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/ambtenaar.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Ambtenaar');
    	$page->setDescription('Ambtenaar');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('ambtenaar');
    	$manager->persist($page);
    	
    	$id = Uuid::fromString('3450ae40-3c07-4e09-83c2-f0c54e3b574a');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/ambtenaren.html.twig', 'r'));
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
    	$slug->setSlug('ambtenaren');
    	$manager->persist($page);
    	
    	// Locatie
    	$id = Uuid::fromString('e2615a62-95a5-43a4-8ab7-efaa8777ed7f');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/locatie.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	$manager->persist($template);
    	$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Locati');
    	$page->setDescription('Locatie');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('locatie');
    	$manager->persist($page);
    	
    	$id = Uuid::fromString('0bd283c4-771c-4ee0-b87f-8ce40dabe6a1');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/locaties.html.twig', 'r'));
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
    	//$id = Uuid::fromString('50409369-6f28-4f9e-b074-2fa638d1b25a');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/extra.html.twig', 'r'));
    	$template->setTemplateEngine('twig');
    	//$manager->persist($template);
    	//$template->setId($id);
    	$manager->persist($template);
    	$manager->flush();
    	//$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));
    	
    	$page = New Page;
    	$page->setTitle('Extra');
    	$page->setDescription('Extra');
    	$page->setApplication($application);
    	$page->setTemplate($template);
    	$manager->persist($page);
    	
    	$slug = New Slug;
    	$slug->setPage($page);
    	$slug->setApplication($application);
    	$slug->setSlug('extra');
    	$manager->persist($page);
    	
    	
    	$id = Uuid::fromString('50409369-6f28-4f9e-b074-2fa638d1b25a');
    	$template = New Template;
    	$template->setContent(file_get_contents(dirname(__FILE__).'/Resources/extras.html.twig', 'r'));
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
