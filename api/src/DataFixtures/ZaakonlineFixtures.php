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

class ZaakonlineFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }
    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if ($this->params->get('app_domain') != "zaakonline.nl" && strpos($this->params->get('app_domain'), "zaakonline.nl") == false) {
            return false;
        }
        var_dump($this->params->get('app_domain'));

    	// Utrecht
    	$id = Uuid::fromString('8fc083b2-b110-4289-af17-c840eb4f5f04');
    	$utrecht = new Organization();
    	$utrecht->setName('Utrecht');
    	$utrecht->setDescription('Gemeente Utrecht');
    	$utrecht->setRsin('');
    	$utrecht->setContact('https://cc.zaakonline.nl/organizations/95c3da92-b7d3-4ea0-b6d4-3bc24944e622');
    	$manager->persist($utrecht);
    	$utrecht->setId($id);
    	$manager->persist($utrecht);
    	$manager->flush();
    	$utrecht= $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

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
        $application->setName('ZaakOnline');
        $application->setDescription('ZaakOnline');
        $application->setDomain('zaakonline.nl');
        $application->setOrganization($utrecht);
        $manager->persist($utrecht);

        // Berichten

        $id = Uuid::fromString('355b786c-c469-4f57-8810-6670e3fca9a2');
        $template = new Template();
        $template->setName('Bevestiging Melding');
        $template->setDescription('Bericht dat het verzoek ontvangen is');
        $template->setContent('Wij hebben uw verzoek ontvangen');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('cbc6cf21-68f6-4926-a404-023bed919285');
        $template = new Template();
        $template->setName('Aanvraag ontvangen');
        $template->setDescription('Bericht dat het verzoek ontvangen is');
        $template->setContent('Uw aanvraag is ontvangen en word zo spoedig mogelijk beoordeeld. U ontvangt uiterlijk over (x dagen, tijd, etc) een bevestiging van uw reservering.');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('cfe4b5ab-6569-48d2-a79c-79d8b789e35e');
        $template = new Template();
        $template->setName('Bevestiging aanvraag');
        $template->setDescription('Bericht dat het verzoek ontvangen is');
        $template->setContent('Bevestiging van de daadwerkelijke datum, tijd, locatie, babs etc.');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('2b1ccee5-4232-4999-8d17-812b3f6d8058');
        $template = new Template();
        $template->setName('Uitgenodigd');
        $template->setDescription('Bericht dat een persoon/organisatie uitgenodigd is');
        $template->setContent('U bent uitgenodigd als {{ role }}, klik op deze link om te bevestigen');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('4f0029ff-3360-437e-8f0b-13bbec088d4b');
        $template = new Template();
        $template->setName('Aanvraag');
        $template->setDescription('Bericht dat er een aanvraag is');
        $template->setContent('Er is een aanvraag voor u als trouw ambtenaar, kijk op uw dashboard om deze te acepteren');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('aa4270c7-4312-4b0c-992f-c0429d306830');
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
        $id = Uuid::fromString('0a0bbc82-8cd9-4496-a56c-0214909fbedc');
        $template = new Template();
        $template->setName('Noodvoorziening Corona kleine ondernemers');
        $template->setDescription('Noodvoorziening Corona kleine ondernemers');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/noodvoorziening-corona.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);

        // Hacky
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        $slug = new Slug();
        $slug->setPage($page);
        $slug->setApplication($application);
        $slug->setSlug('noodvoorziening-corona');
        $slug->setName('noodvoorziening-corona');
        $manager->persist($page);

    }
}
