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

class SHertogenboschFixtures extends Fixture
{
    private $params;
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->commonGroundService = $commonGroundService;
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'shertogenbosch.commonground.nu' && strpos($this->params->get('app_domain'), 'shertogenbosch.commonground.nu') == false &&
            $this->params->get('app_domain') != 'verhuizen.accp.s-hertogenbosch.nl' && strpos($this->params->get('app_domain'), 'verhuizen.accp.s-hertogenbosch.nl') == false &&
            $this->params->get('app_domain') != 'verhuizen.s-hertogenbosch.nl' && strpos($this->params->get('app_domain'), 'verhuizen.s-hertogenbosch.nl') == false &&
            $this->params->get('app_domain') != 's-hertogenbosch.commonground.nu' && strpos($this->params->get('app_domain'), 's-hertogenbosch.commonground.nu') == false
        ) {
            return false;
        }

        // Deze organisaties worden ook buiten het wrc gebruikt

        // -Hertogenbosch
        $id = Uuid::fromString('4f387d0e-a2e5-44c0-9902-c31b63a8ee36');
        $sHertogenbosch = new Organization();
        $sHertogenbosch->setName('\'s-Hertogenbosch');
        $sHertogenbosch->setDescription('Gemeente \'s-Hertogenbosch');
        $sHertogenbosch->setRsin('001709124');
        $manager->persist($sHertogenbosch);
        $sHertogenbosch->setId($id);
        $manager->persist($sHertogenbosch);
        $manager->flush();
        $sHertogenbosch = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('abb989de-414b-44ef-b899-5a0daa87a5d7');
        $favicon = new Image();
        $favicon->setName('\'s-Hertogenbosch Favicon');
        $favicon->setDescription('\'s-Hertogenbosch VNG');
        $favicon->setOrganization($sHertogenbosch);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('\'s-Hertogenbosch Logo');
        $logo->setDescription('\'s-Hertogenbosch VNG');
        $logo->setOrganization($sHertogenbosch);

        $style = new Style();
        $style->setName('Gemeente \'s-Hertogenbosch');
        $style->setDescription('Huistlijl Gemeente \'s-Hertogenbosch');
        $style->setCss(':root {--primary: #AD9156;--secondary: #00205C;--secondary2: #2A5587;}.main-title
        {color: white !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
        .bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');
        $style->setfavicon($favicon);
        $style->addOrganization($sHertogenbosch);

        $manager->persist($logo);
        $manager->persist($style);
        $manager->flush();

        // Mijn App
        $application = new Application();
        $application->setName('MijnApp');
        $application->setDescription('MijnApp');
        $application->setDomain('huwelijksplanner.online');
        $application->setOrganization($sHertogenbosch);
        $manager->persist($application);

        // Configuratie van MijnApp
        $configuration = new Configuration();
        $configuration->setOrganization($sHertogenbosch);
        $configuration->setApplication($application);
        $configuration->setConfiguration([]);
        $manager->persist($configuration);

        $manager->flush();
    }
}
