<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Image;
use App\Entity\Organization;
use App\Entity\Style;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WestfrieslandFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        if (
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' &&
            strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' &&
            strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false
        ) {
            return false;
        }
        // West-Friesland
        $id = Uuid::fromString('d280c4d3-6310-46db-9934-5285ec7d0d5e');
        $westfriesland = new Organization();
        $westfriesland->setName('Westfriesland');
        $westfriesland->setDescription('Samenwerkingsverband Westfriesland');
        $westfriesland->setRsin('1234');
        $manager->persist($westfriesland);
        $westfriesland->setId($id);
        $manager->persist($westfriesland);
        $manager->flush();
        $westfriesland = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Opmeer
        $id = Uuid::fromString('16fd1092-c4d3-4011-8998-0e15e13239cf');
        $opmeer = new Organization();
        $opmeer->setName('Opmeer');
        $opmeer->setDescription('Gemeente Opmeer');
        $opmeer->setRsin('1234');
        $manager->persist($opmeer);
        $opmeer->setId($id);
        $manager->persist($opmeer);
        $manager->flush();
        $opmeer = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Medemblik
        $id = Uuid::fromString('429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $medemblik = new Organization();
        $medemblik->setName('Medemblik');
        $medemblik->setDescription('Gemeente Medemblik');
        $medemblik->setRsin('1234');
        $manager->persist($medemblik);
        $opmeer->setId($id);
        $manager->persist($medemblik);
        $manager->flush();
        $medemblik = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // SED
        $id = Uuid::fromString('7033eeb4-5c77-4d88-9f40-303b538f176f');
        $sed = new Organization();
        $sed->setName('SED');
        $sed->setDescription('Gemeenten Stede Broec, Enkhuizen en Drechterland');
        $sed->setRsin('1234');
        $manager->persist($sed);
        $sed->setId($id);
        $manager->persist($sed);
        $manager->flush();
        $sed = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Hoorn
        $id = Uuid::fromString('d736013f-ad6d-4885-b816-ce72ac3e1384');
        $hoorn = new Organization();
        $hoorn->setName('Hoorn');
        $hoorn->setDescription('Gemeente Hoorn');
        $hoorn->setRsin('1234');
        $manager->persist($hoorn);
        $hoorn->setId($id);
        $manager->persist($hoorn);
        $manager->flush();
        $hoorn = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Koggenland
        $id = Uuid::fromString('f050292c-973d-46ab-97ae-9d8830a59d15');
        $koggenland = new Organization();
        $koggenland->setName('Opmeer');
        $koggenland->setDescription('Gemeente Opmeer');
        $koggenland->setRsin('1234');
        $manager->persist($koggenland);
        $koggenland->setId($id);
        $manager->persist($koggenland);
        $manager->flush();
        $koggenland = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('West-Friesland Favicon');
        $favicon->setDescription('West-Friesland VNG');
        $favicon->setOrganization($westfriesland);

        $logo = new Image();
        $logo->setName('West-Friesland Logo');
        $logo->setDescription('West-Friesland VNG');
        $logo->setOrganization($westfriesland);

        $style = new Style();
        $style->setName('West-Friesland');
        $style->setDescription('Huistlijl samenwerkingsverband West-Friesland');
        $style->setCss(':root {--primary: #233A79;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;}');
        $style->setfavicon($favicon);
        $style->setOrganization($westfriesland);
        $style->setfavicon($favicon);

        $manager->persist($westfriesland);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Begrafenisplanner
        $id = Uuid::fromString('3f44c00e-d919-4f89-bd4c-b730c9b2620a');
        $application = new Application();
        $application->setName('Begrafenisplanner');
        $application->setDescription('Begrafenisplanner');
        $application->setDomain('westfriesland.commonground.nu');
        $application->setOrganization($westfriesland);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);
    }
}
