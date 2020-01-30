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

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   	
    	// Utrecht
    	$utrecht = new Organization();
    	$utrecht->setName('Utrecht');
    	$utrecht->setDescription('Gemeente Utrecht');
    	$utrecht->setRsin('');
    	$manager->persist($utrecht);
    	
    	$favicon = new Image();
    	$favicon->setName('VNG Favicon');
    	$favicon->setDescription('Favicon VNG');
    	$favicon->setOrganization($utrecht);
    	
    	$logo = new Image();
    	$logo->setName('VNG Logo');
    	$logo->setDescription('Logo VNG');
    	$logo->setOrganization($utrecht);
    	
    	$style = new Style();
    	$style->setName('Utrecht');
    	$style->setDescription('Huistlijl Gemeente Utrecht');
    	$style->setCss('');
    	$style->setfavicon($favicon);
    	$style->setOrganization($utrecht);
    	
    	$utrecht->setLogo($logo);
    	
    	$manager->persist($utrecht);
    	$manager->persist($favicon);
    	$manager->persist($logo);
    	$manager->persist($style);
    	
    	$manager->flush();
    	
    	// Rotterdam
    	$rotterdam= new Organization();
    	$rotterdam->setName('Rotterdam');
    	$rotterdam->setDescription('Gemeente Rotterdam');
    	$rotterdam->setRsin('');
    	
    	$favicon = new Image();
    	$favicon->setName('VNG Favicon');
    	$favicon->setDescription('Favicon VNG');
    	$favicon->setOrganization($rotterdam);
    	
    	$logo = new Image();
    	$logo->setName('VNG Logo');
    	$logo->setDescription('Logo VNG');
    	$logo->setOrganization($rotterdam);
    	
    	$style = new Style();
    	$style->setName('Utrecht');
    	$style->setDescription('Huistlijl Gemeente Utrecht');
    	$style->setCss('');
    	$style->setfavicon($favicon);
    	$style->setOrganization($rotterdam);
    	
    	$rotterdam->setLogo($logo);
    	
    	$manager->persist($rotterdam);
    	$manager->persist($favicon);
    	$manager->persist($logo);
    	$manager->persist($style);
    	
    	$manager->flush();
    	
    	// Rotterdam
    	$eindhoven= new Organization();
    	$eindhoven->setName('Eindhoven');
    	$eindhoven->setDescription('Gemeente Eindhoven');
    	$eindhoven->setRsin('');
    	
    	$favicon = new Image();
    	$favicon->setName('Gemeente Eindhoven Favicon');
    	$favicon->setDescription('Favicon Gemeente Eindhoven');
    	$favicon->setOrganization($eindhoven);
    	
    	$logo = new Image();
    	$logo->setName('Gemeente Eindhoven Logo');
    	$logo->setDescription('Logo Gemeente Eindhoven');
    	$logo->setOrganization($eindhoven);
    	
    	$style = new Style();
    	$style->setName('Gemeente Eindhoven');
    	$style->setDescription('Huistlijl Gemeente Eindhoven');
    	$style->setCss('');
    	$style->setfavicon($favicon);
    	$style->setOrganization($eindhoven);
    	
    	$eindhoven->setLogo($logo);
    	
    	$manager->persist($eindhoven);
    	$manager->persist($favicon);
    	$manager->persist($logo);
    	$manager->persist($style);
    	
    	$manager->flush();
    	
    	// VNG
    	$vng = new Organization();
    	$vng->setName('VNG');
    	$vng->setDescription('Vereniging Nederlandse Gemeente');
    	$vng->setRsin('');
    	$manager->persist($vng);    	
    	
    	$favicon = new Image();
    	$favicon->setName('VNG Favicon');
    	$favicon->setDescription('Favicon VNG');
    	$favicon->setOrganization($vng);  
    	
    	$logo = new Image();
    	$logo->setName('VNG Logo');
    	$logo->setDescription('Logo VNG');
    	$logo->setOrganization($vng);  
    	
    	$style = new Style();
    	$style->setName('Utrecht');
    	$style->setDescription('Huistlijl Gemeente Utrecht');
    	$style->setCss('');
    	$style->setfavicon($favicon);
    	$style->setOrganization($vng);  
    	
    	$vng->setLogo($logo);    	
    	
    	$manager->persist($vng);
    	$manager->persist($favicon);
    	$manager->persist($logo);
    	$manager->persist($style);
    	
    	$manager->flush();
    	
        // Home
        $application = new Application();
        $application->setName('MijnApp');
        $application->setDescription('MijnApp'); 
        $application->setDomain('huwelijksplanner.online'); 
        $application->setOrganization($eindhoven);
        $manager->persist($application);

        // Home
        $id = Uuid::fromString('536bfb73-63a5-4719-b535-d835607b88b2');
        $application = new Application();
        $application->setName('Huwelijksplanner');
        $application->setDescription('Huwelijksplanner');
        $application->setDomain('huwelijksplanner.online');
        $application->setOrganization($utrecht);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Berichten
        $id = Uuid::fromString('b93e6cdf-ed0c-49e7-9975-e6b31f3ebed2');
        $template = new Template();
        $template->setName('Verzoek ontvangen');
        $template->setDescription('Bericht dat het verzoek ontvangen is');
        $template->setContent('Wij hebben uw verzoek ontvangen');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('2d56603e-65b3-4b17-81f7-d88ac8bb4e7f');
        $template = new Template();
        $template->setName('Uitgenodigd');
        $template->setDescription('Bericht dat een persoon/organisatie uitgenodigd is');
        $template->setContent('U bent uitgenodigd als {{ role }}, klik op deze link om te bevestigen');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('a36433e4-3c9b-4df5-bf85-1a80bd2ae2ce');
        $template = new Template();
        $template->setName('Aanvraag');
        $template->setDescription('Bericht dat er een aanvraag is');
        $template->setContent('Er is een aanvraag voor u als trouw ambtenaar, kijk op uw dashboard om deze te acepteren');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('88fefee9-474c-4713-a55c-0ca460882d8d');
        $template = new Template();
        $template->setName('Boeking');
        $template->setDescription('Bericht dat er een boeking is');
        $template->setContent('Er is een boeking voor uw locaties, kijk op uw dashboard om deze te acepteren');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        // Assent
        $id = Uuid::fromString('016d30d8-34dd-4841-a4af-8ad0a0f9d23f');
        $template = new Template();
        $template->setName('Instemming');
        $template->setDescription('Pagina waarop instemming kan worden verleend');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/assent.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Assent');
        $page->setDescription('Assent');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('assent');
        $manager->persist($page);

        // Trouwen (ofwel home)
        $id = Uuid::fromString('20219e4b-4dd0-4dc9-8768-3ecb33cf3d78');
        $template = new Template();
        $template->setName('Trouwen');
        $template->setDescription('De homepage van de trouw applicatie');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/trouwen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Trouwen');
        $page->setDescription('trouwen');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('trouwen');
        $manager->persist($page);

        // flow
        $id = Uuid::fromString('ba71c65e-7a82-449e-af15-947613ca6caa');
        $template = new Template();
        $template->setName('Checklist');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/checklist.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Checklist');
        $page->setDescription('Checklist');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('checklist');
        $manager->persist($page);

        // flow
        $id = Uuid::fromString('cb0ada5b-185a-4c64-af20-9a21ac4deb3b');
        $template = new Template();
        $template->setName('Flow');
        $template->setDescription('Het boven menu (indien ingelogd) van de trouwplanner');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/flow.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Flow');
        $page->setDescription('Flow');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('flow');
        $manager->persist($page);

        // requests
        $id = Uuid::fromString('1855950c-e4b6-4a11-bfc7-5a2af7101b68');
        $template = new Template();
        $template->setName('Verzoeken');
        $template->setDescription('De verzoeks overizhcts pagina die wordt getoond na inloggen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/requests.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Requests');
        $page->setDescription('Requests');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('requests');
        $manager->persist($page);
        
        
        $id = Uuid::fromString('5b9fdd2f-273e-49c3-aa8d-2377be792b76');
        $template = new Template();
        $template->setName('Niew verzoek');
        $template->setDescription('De verzoeks overzichts pagina die wordt getoond na inloggen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/new-request.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        
        $page = new Page();
        $page->setTitle('Niew verzoek');
        $page->setDescription('Niew verzoek');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);
        
        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('new-request');
        $manager->persist($page);        
        
        
        
        $id = Uuid::fromString('5b9fdd2f-273e-49c3-aa8d-2377be792b76');
        $template = new Template();
        $template->setName('Formulier');
        $template->setDescription('Een formulier pagina');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/form.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        
        $page = new Page();
        $page->setTitle('Formulier');
        $page->setDescription('Formulier');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);
        
        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('form');
        $manager->persist($page);        
        
        // Organizations        
        $id = Uuid::fromString('f99412f1-6e44-4a75-bc99-99201d08c4c8');
        $template = new Template();
        $template->setName('Organisaties');
        $template->setDescription('ia deze pagina kan er worden gewizeld van organisatie');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/organizations.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        
        $page = new Page();
        $page->setTitle('Wissel organisatie');
        $page->setDescription('Via deze pagina kan er worden gewizeld van organisatie');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);
        
        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('organizations');
        $manager->persist($page); 

        // Getuigen
        $id = Uuid::fromString('da78b8bb-16bf-449c-96e3-3615e9e8e2af');
        $template = new Template();
        $template->setName('Getuigen kiezen');
        $template->setDescription('Informatie pagina over getuigen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/getuigen-kiezen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Getuigen');
        $page->setDescription('Over getuigen');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('getuigen-kiezen');
        $manager->persist($page);

        // Getuigen
        $id = Uuid::fromString('75de9a49-e89a-4a9d-8efc-135be48e98ac');
        $template = new Template();
        $template->setName('Getuigen');
        $template->setDescription('Pagina waarop getuigen kunnen worden toegevoegd');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/getuigen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Getuigen');
        $page->setDescription('Over getuigen');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('getuige');
        $manager->persist($page);

        // Naamsgerbuik
        $id = Uuid::fromString('648e2ce2-e157-42ac-8bac-1fa59032bbfc');
        $template = new Template();
        $template->setName('Naamsgebruik');
        $template->setDescription('Pagina over naamsgebruik bij een huwelijk');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/naamsgebruik.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Naamsgebruik');
        $page->setDescription('Over naamsgebruik');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('naamsgebruik');
        $manager->persist($page);

        // Melding
        $id = Uuid::fromString('ea817100-a03d-4fd3-ae7b-3d39b9c577f9');
        $template = new Template();
        $template->setName('Melding');
        $template->setDescription('Pagina met informatie over het doen van een melding van een huwelijk');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/melding.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Melding');
        $page->setDescription('Over melding');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('melding');
        $manager->persist($page);

        // Plechtigheid
        $id = Uuid::fromString('013276cc-1483-46b4-ad5b-1cba5acf6d9f');
        $template = new Template();
        $template->setName('Plechtigheid');
        $template->setDescription('Pagina waarop het product voor het huwelijk kan worden gekozen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/plechtigheden.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Plechtigheid');
        $page->setDescription('Plechtigheid');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('plechtigheid');
        $manager->persist($page);
        
        
        $id = Uuid::fromString('310d1039-abdf-4983-9030-608cd3012306');
        $template = new Template();
        $template->setName('Plechtigheid');
        $template->setDescription('Pagina waarop het product voor het huwelijk kan worden gekozen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/plechtigheid.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        
        $page = new Page();
        $page->setTitle('Plechtigheid');
        $page->setDescription('Plechtigheid');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);
        
        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('plechtigheid-kiezen');
        $manager->persist($page);

        // Ceremonie
        $id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
        $template = new Template();
        $template->setName('Cremonies');
        $template->setDescription('Pagina waarop een trouw ceremonie kan worden gekozen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/ceremonies.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Ceremonies');
        $page->setDescription('Ceremonies');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('ceremonie');
        $manager->persist($page);

        // Partners
        //$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
        $template = new Template();
        $template->setName('Partners');
        $template->setDescription('De pagina waarop je partners kan toevoegen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/partners.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        //$manager->persist($template);
        //$template->setId($id);
        $manager->persist($template);
        $manager->flush();
        //$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));

        $page = new Page();
        $page->setTitle('Partners');
        $page->setDescription('Partners');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('partner');
        $manager->persist($page);

        // Datum
        //$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
        $template = new Template();
        $template->setName('Datum');
        $template->setDescription('De pagina waarop je een datum kan selecteren');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/datum.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        //$manager->persist($template);
        //$template->setId($id);
        $manager->persist($template);
        $manager->flush();
        //$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));

        $page = new Page();
        $page->setTitle('Datum');
        $page->setDescription('Datum');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('datum');
        $manager->persist($page);

        // Betalen
        //$id = Uuid::fromString('1370d87a-fe90-4826-a210-fd8e1c065576');
        $template = new Template();
        $template->setName('Betalen');
        $template->setDescription('De pagina waarop je kan betalen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/betalen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        //$manager->persist($template);
        //$template->setId($id);
        $manager->persist($template);
        $manager->flush();
        //$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));

        $page = new Page();
        $page->setTitle('betalen');
        $page->setDescription('betalen');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('betalen');
        $manager->persist($page);

        // Products
        $id = Uuid::fromString('14df39f8-46f7-49b4-9b0c-c1c4761bcb2f');
        $template = new Template();
        $template->setName('Product');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/product.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Product');
        $page->setDescription('Product');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('product');
        $manager->persist($page);

        $id = Uuid::fromString('b747ea1f-e061-4ec8-8f92-959f6a1e2dd0');
        $template = new Template();
        $template->setName('Producten');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/products.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Producten');
        $page->setDescription('Producten');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('producten');
        $manager->persist($page);

        // Ambtenaren
        $id = Uuid::fromString('28268026-6f82-4b19-8dc7-a325edfeca82');
        $template = new Template();
        $template->setName('Ambtenaar');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/ambtenaar.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Ambtenaar');
        $page->setDescription('Ambtenaar');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('ambtenaar-kiezen');
        $manager->persist($page);

        $id = Uuid::fromString('3450ae40-3c07-4e09-83c2-f0c54e3b574a');
        $template = new Template();
        $template->setName('Ambtenaren');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/ambtenaren.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Ambtenaren');
        $page->setDescription('Ambtenaren');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('ambtenaar');
        $manager->persist($page);

        // Locatie
        $id = Uuid::fromString('e2615a62-95a5-43a4-8ab7-efaa8777ed7f');
        $template = new Template();
        $template->setName('Locatie');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/locatie.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Locati');
        $page->setDescription('Locatie');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('locatie-kiezen');
        $manager->persist($page);

        $id = Uuid::fromString('0bd283c4-771c-4ee0-b87f-8ce40dabe6a1');
        $template = new Template();
        $template->setName('Locaties');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/locaties.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Locatie');
        $page->setDescription('Locaties');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('locatie');
        $manager->persist($page);

        // Extras
        //$id = Uuid::fromString('50409369-6f28-4f9e-b074-2fa638d1b25a');
        $template = new Template();
        $template->setName('Extra');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/extra.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        //$manager->persist($template);
        //$template->setId($id);
        $manager->persist($template);
        $manager->flush();
        //$template= $manager->getRepository('App:Template')->findOneBy(array('id'=> $id));

        $page = new Page();
        $page->setTitle('Extra');
        $page->setDescription('Extra');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('extra-kiezen');
        $manager->persist($page);

        $id = Uuid::fromString('50409369-6f28-4f9e-b074-2fa638d1b25a');
        $template = new Template();
        $template->setName('Extras');
        $template->setDescription('');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/extras.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $page = new Page();
        $page->setTitle('Extras');
        $page->setDescription('Extras');
        $page->setApplication($application);
        $page->setTemplate($template);
        $manager->persist($page);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('extra');
        $manager->persist($page);

        $manager->flush();
    }
}
