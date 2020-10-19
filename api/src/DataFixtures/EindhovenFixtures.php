<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Organization;
use App\Entity\Style;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class EindhovenFixtures extends Fixture
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
            !$this->params->get('app_build_all_fixtures')
            //$this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            //$this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Eindhoven
        $id = Uuid::fromString('1802c00b-c3d9-46a5-848c-5846bca29345');
        $eindhoven = new Organization();
        $eindhoven->setName('Eindhoven');
        $eindhoven->setDescription('Gemeente Eindhoven');
        $eindhoven->setRsin('001902763');
        $manager->persist($eindhoven);
        $eindhoven->setId($id);
        $manager->persist($eindhoven);
        $manager->flush();
        $eindhoven = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('a698233d-3503-4b9e-b398-c0d4447d1012');
        $favicon = new Image();
        $favicon->setName('Gemeente Eindhoven Favicon');
        $favicon->setDescription('Favicon Gemeente Eindhoven');
        $favicon->setOrganization($eindhoven);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Gemeente Eindhoven Logo');
        $logo->setDescription('Logo Gemeente Eindhoven');
        $logo->setOrganization($eindhoven);

        $style = new Style();
        $style->setName('Gemeente Eindhoven');
        $style->setDescription('Huistlijl Gemeente Eindhoven');
        $style->setCss(':root {--primary: white;--primary2: #EF4433;--secondary: #464646;--secondary2: #464646;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');
        $style->setfavicon($favicon);
        $style->addOrganization($eindhoven);
        $eindhoven->setLogo($logo);

        $manager->persist($eindhoven);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Mijn App
        $application = new Application();
        $application->setName('MijnApp');
        $application->setDescription('MijnApp');
        $application->setDomain('huwelijksplanner.online');
        $application->setOrganization($eindhoven);
        $manager->persist($application);

        // Configuratie van MijnApp
        $configuration = new Configuration();
        $configuration->setOrganization($eindhoven);
        $configuration->setApplication($application);
        $configuration->setConfiguration([]);
        $manager->persist($configuration);
    }
}
