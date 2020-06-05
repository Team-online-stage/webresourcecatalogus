<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Organization;
use App\Entity\Slug;
use App\Entity\Style;
use App\Entity\Template;
use App\Entity\TemplateGroup;
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
            $this->params->get('app_domain') != 'huwelijksplanner.online' &&
            strpos($this->params->get('app_domain'), 'huwelijksplanner.online') == false &&
            $this->params->get('app_domain') != 'utrecht.commonground.nu' &&
            strpos($this->params->get('app_domain'), 'utrecht.commonground.nu') == false
        ) {
            return false;
        }

        // Deze organisaties worden ook buiten het wrc gebruikt

        // -Hertogenbosch
        $id = Uuid::fromString('fed9339e-57d5-4f63-ab68-694759705c19');
        $sHertogenbosch = new Organization();
        $sHertogenbosch->setName('\'s-Hertogenbosch');
        $sHertogenbosch->setDescription('Gemeente \'s-Hertogenbosch');
        $sHertogenbosch->setRsin('001709124');
        $manager->persist($sHertogenbosch);
        $sHertogenbosch->setId($id);
        $manager->persist($sHertogenbosch);
        $manager->flush();
        $sHertogenbosch = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('\'s-Hertogenbosch Favicon');
        $favicon->setDescription('\'s-Hertogenbosch VNG');
        $favicon->setOrganization($sHertogenbosch);

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
        $style->setOrganization($sHertogenbosch);

        $manager->persist($favicon);
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


    }
}
