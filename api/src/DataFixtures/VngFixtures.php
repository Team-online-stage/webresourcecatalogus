<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Organization;
use App\Entity\Style;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class VngFixtures extends Fixture
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

        // VNG
        $id = Uuid::fromString('6d879677-79e3-4daa-a50d-a29762b0064c');
        $organisation = new Organization();
        $organisation->setName('VNG');
        $organisation->setDescription('Vereniging Nederlandse Gemeente');
        $organisation->setRsin('');
        $manager->persist($organisation);
        $organisation->setId($id);
        $manager->persist($organisation);
        $manager->flush();
        $organisation = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('f816f810-2206-4108-99d9-fe4f467a093f');
        $favicon = new Image();
        $favicon->setName('VNG Favicon');
        $favicon->setDescription('Favicon VNG');
        $favicon->setOrganization($organisation);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('VNG Logo');
        $logo->setDescription('Logo VNG');
        $logo->setOrganization($organisation);

        $style = new Style();
        $style->setName('VNG');
        $style->setDescription('Huistlijl VNG');
        $style->setCss(':root {--primary: white;--primary2: #233A79;--secondary: #004488;--secondary2: #0277BD;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');
        $style->addOrganization($organisation);
        $style->setfavicon($favicon);

        $organisation->setLogo($logo);

        $manager->persist($organisation);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
    }
}
