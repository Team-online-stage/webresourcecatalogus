<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Organization;
use App\Entity\Slug;
use App\Entity\Style;
use App\Entity\Template;
use App\Entity\TemplateGroup;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CheckinFixtures extends Fixture implements DependentFixtureInterface
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

    public function getDependencies()
    {
        return [
            ConductionFixtures::class,
            ZuiddrechtFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'checking.nu' && strpos($this->params->get('app_domain'), 'checking.nu') == false &&
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Cafe de zotte raaf
        $id = Uuid::fromString('8b3f28c4-4163-47f1-9242-a4050bc26ede');
        $organization = new Organization();
        $organization->setName('Cafe de zotte raaf');
        $organization->setDescription('Cafe de zotte raaf');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'0265628a-1b0e-4505-bba9-370e5ca88671']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('dea53810-4aca-4232-ae8a-a61b14ff707a');
        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('Cafe de zotte raaf');
        $style->setDescription('Huistlijl Cafe de zotte raaf');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('a3c5906a-5cd2-4a51-82a6-5833bfa094e1');
        $organization = new Organization();
        $organization->setName('Restautant Goudlust');
        $organization->setDescription('Restautant Goudlust');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'0550d019-502d-480a-ab46-6ed75bc8551a']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('bf517480-2f59-4a68-836d-dc8aca30a23f');
        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('Restautant Goudlust');
        $style->setDescription('Huistlijl Restautant Goudlust');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('f302b75e-a233-4ddf-95b5-f8603f2e80e9');
        $organization = new Organization();
        $organization->setName('Hotel Dijkzicht');
        $organization->setDescription('Hotel Dijkzicht');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'0265628a-1b0e-4505-bba9-370e5ca88671']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('7cf8771e-ecfd-4cf6-a8a5-6d6d8209c275');
        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('Hotel Dijkzicht');
        $style->setDescription('Huistlijl otel Dijkzicht');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('0d3b7b6d-5ab2-442b-b4ff-472fd4112922');
        $organization = new Organization();
        $organization->setName('Camping de alpen koe');
        $organization->setDescription('Camping de alpen koe');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'ff46b373-bcb3-4b9a-9837-c50c15915158']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('98173658-5153-403b-b9ae-92fded24eb4a');
        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('Camping de alpen koe');
        $style->setDescription('Huistlijl Camping de alpen koe');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('e3137e4f-e44d-4400-adbd-0fa1b4be9d65');
        $organization = new Organization();
        $organization->setName('Mc Donalds Zuid-Drecht');
        $organization->setDescription('Mc Donalds Zuid-Drecht');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'35ca41b8-045d-4e52-a011-124ad37b5f04']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('9a6a9e8a-b07d-4021-9f4e-74e1e0d581d9');
        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('Mc Donalds Zuid-Drecht');
        $style->setDescription('Huistlijl Mc Donalds Zuid-DrechtGround');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('62bff497-cb91-443e-9da9-21a0b38cd536');
        $organization = new Organization();
        $organization->setName('Creative Grounds');
        $organization->setDescription('Creative Grounds');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'e11acb98-1fb3-4ae5-beea-1a33aa381d1a']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('5fdbff8f-9702-4bf9-acb2-0dda5e482e1f');
        $favicon = new Image();
        $favicon->setName('Creative Groundf favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('data:image/svg+xml;base64,PHN2ZyBpZD0iTGFhZ18xIiBkYXRhLW5hbWU9IkxhYWcgMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMzkwLjAxIDQ2Ljg3Ij48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2ZmZjt9PC9zdHlsZT48L2RlZnM+PGcgaWQ9IkxheWVyXzIiIGRhdGEtbmFtZT0iTGF5ZXIgMiI+PGcgaWQ9Im1lbnUiPjxwYXRoIGlkPSJQYXRoXzEiIGRhdGEtbmFtZT0iUGF0aCAxIiBjbGFzcz0iY2xzLTEiIGQ9Ik03Ni42NiwzNC43MWExMi4yNCwxMi4yNCwwLDAsMS00LjI4Ljc0QTEyLjQ3LDEyLjQ3LDAsMCwxLDY2LDMzLjg0YTEwLjkxLDEwLjkxLDAsMCwxLTQuMTktNC4zMywxMi41MywxMi41MywwLDAsMS0xLjQ0LTYsMTMuNzksMTMuNzksMCwwLDEsMS40NC02LjM3LDEwLjczLDEwLjczLDAsMCwxLDQuMDYtNC4zNiwxMS41LDExLjUsMCwwLDEsNi0xLjU2LDEzLjE3LDEzLjE3LDAsMCwxLDQsLjU4QTEzLjgxLDEzLjgxLDAsMCwxLDc5LDEzLjI4bC0xLjgsNC40MUE4LjU4LDguNTgsMCwwLDAsNzIsMTUuNzZhNi4yMyw2LjIzLDAsMCwwLTMuMzcsMSw3LjM3LDcuMzcsMCwwLDAtMi41MSwyLjcyLDcuODMsNy44MywwLDAsMC0uOTQsMy44Miw4LjgsOC44LDAsMCwwLC44Nyw0QTYuNTQsNi41NCwwLDAsMCw2OC41MiwzMGE3LjIxLDcuMjEsMCwwLDAsMy43NiwxLDguMSw4LjEsMCwwLDAsMy4xMi0uNTZBNi42Nyw2LjY3LDAsMCwwLDc3LjU5LDI5bDEuOTMsNC4xOUExMC42MiwxMC42MiwwLDAsMSw3Ni42NiwzNC43MVoiLz48cGF0aCBpZD0iUGF0aF8yIiBkYXRhLW5hbWU9IlBhdGggMiIgY2xhc3M9ImNscy0xIiBkPSJNOTcsMzUuMTlsLTUtNy41M0g4OC44NXY3LjUzSDg0LjE5VjExLjUxaDcuMTdhMTAsMTAsMCwwLDEsNi44NCwyLjE0LDcuMzYsNy4zNiwwLDAsMSwyLjQzLDUuODQsOS4yNCw5LjI0LDAsMCwxLS45Miw0LjEsNi43NCw2Ljc0LDAsMCwxLTIuODEsM2w1LjUsOC41OVptLTguMTEtMTJoMy4zMkEzLjI4LDMuMjgsMCwwLDAsOTUsMjIuMDhhMy43NiwzLjc2LDAsMCwwLC44Ny0yLjQsNC40OSw0LjQ5LDAsMCwwLS43NC0yLjQ2QTMuMTMsMy4xMywwLDAsMCw5Mi4yLDE2SDg4Ljg1WiIvPjxwYXRoIGlkPSJQYXRoXzMiIGRhdGEtbmFtZT0iUGF0aCAzIiBjbGFzcz0iY2xzLTEiIGQ9Ik0xMjIuNDEsMTEuNTFWMTZIMTEwLjkydjUuMDZoMTAuMTd2NC41SDExMC45MnY1LjExaDExLjk0djQuNTFoLTE2LjZWMTEuNTFaIi8+PHBhdGggaWQ9IlBhdGhfNCIgZGF0YS1uYW1lPSJQYXRoIDQiIGNsYXNzPSJjbHMtMSIgZD0iTTEzOS4zOSwzMC41NmgtNy44NWwtMS45Myw0LjYzSDEyNUwxMzUuNywxMC41OEgxMzZsMTAuNjgsMjQuNjFoLTUuNFptLTEuNTQtMy45My0yLjI4LTUuNzYtMi4zOCw1Ljc2WiIvPjxwYXRoIGlkPSJQYXRoXzUiIGRhdGEtbmFtZT0iUGF0aCA1IiBjbGFzcz0iY2xzLTEiIGQ9Ik0xNjIuNDksMTEuNTFWMTZoLTUuNzVWMzUuMTloLTQuNjdWMTZoLTUuNTNWMTEuNVoiLz48cGF0aCBpZD0iUGF0aF82IiBkYXRhLW5hbWU9IlBhdGggNiIgY2xhc3M9ImNscy0xIiBkPSJNMTcxLjY2LDExLjUxVjM1LjE5SDE2N1YxMS41MVoiLz48cGF0aCBpZD0iUGF0aF83IiBkYXRhLW5hbWU9IlBhdGggNyIgY2xhc3M9ImNscy0xIiBkPSJNMTk3LjM3LDExLjUxLDE4Ni41NiwzNi4yOCwxNzUuNzUsMTEuNTFoNS42bDUuNCwxMy4zNSw1LjA5LTEzLjM1WiIvPjxwYXRoIGlkPSJQYXRoXzgiIGRhdGEtbmFtZT0iUGF0aCA4IiBjbGFzcz0iY2xzLTEiIGQ9Ik0yMTcuNjEsMTEuNTFWMTZIMjA2LjEydjUuMDZoMTAuMTd2NC41SDIwNi4xMnY1LjExaDExLjk0djQuNTFoLTE2LjZWMTEuNTFaIi8+PHBhdGggaWQ9IlBhdGhfOSIgZGF0YS1uYW1lPSJQYXRoIDkiIGNsYXNzPSJjbHMtMSIgZD0iTTI0My4xLDMzLjI3YTE3LjY4LDE3LjY4LDAsMCwxLTMuMDksMSwxMy4zNCwxMy4zNCwwLDAsMS0zLjA4LjQsMTQuMjksMTQuMjksMCwwLDEtNi42MS0xLjQ2LDEwLjc0LDEwLjc0LDAsMCwxLTQuMzktNC4wNiwxMS4zMiwxMS4zMiwwLDAsMS0xLjU0LTUuOSwxNCwxNCwwLDAsMSwxLjY0LTcsMTAuNjUsMTAuNjUsMCwwLDEsNC40MS00LjMxLDEzLDEzLDAsMCwxLDYuMTEtMS40MywxNi4yLDE2LjIsMCwwLDEsNCwuNDhBMTQuODYsMTQuODYsMCwwLDEsMjQ0LDEyLjI0bC0xLjUxLDQuMzVhMTEuMSwxMS4xLDAsMCwwLTIuNTYtLjk1LDEwLjg4LDEwLjg4LDAsMCwwLTIuNzItLjQ0LDguMzQsOC4zNCwwLDAsMC01LjksMS45Myw3LjUsNy41LDAsMCwwLTIsNS43Myw3LjE3LDcuMTcsMCwwLDAsMSwzLjgxLDYuNDYsNi40NiwwLDAsMCwyLjc4LDIuNSw5LjI1LDkuMjUsMCwwLDAsNC4wNy44Niw2LjcyLDYuNzIsMCwwLDAsMy4yNS0uNjFWMjYuNTZoLTQuMDh2LTQuNUgyNDV2MTBBNiw2LDAsMCwxLDI0My4xLDMzLjI3WiIvPjxwYXRoIGlkPSJQYXRoXzEwIiBkYXRhLW5hbWU9IlBhdGggMTAiIGNsYXNzPSJjbHMtMSIgZD0iTTI2My4xMiwzNC40NGwtNS03LjUzSDI1NXY3LjUzaC00LjY2VjEwLjc2aDcuMTdhMTAsMTAsMCwwLDEsNi44NCwyLjE0LDcuMzYsNy4zNiwwLDAsMSwyLjQzLDUuODQsOS4yNCw5LjI0LDAsMCwxLS45Miw0LjEsNi43NCw2Ljc0LDAsMCwxLTIuODEsM2w1LjUsOC41OVptLTguMTEtMTJoMy4zMmEzLjMsMy4zLDAsMCwwLDIuNzctMS4xMSwzLjgzLDMuODMsMCwwLDAsLjg2LTIuNCw0LjQ5LDQuNDksMCwwLDAtLjc0LTIuNDYsMy4xMSwzLjExLDAsMCwwLTIuODYtMS4xN0gyNTVaIi8+PHBhdGggaWQ9IlBhdGhfMTEiIGRhdGEtbmFtZT0iUGF0aCAxMSIgY2xhc3M9ImNscy0xIiBkPSJNMjcxLjc5LDE2LjYyYTEyLjMyLDEyLjMyLDAsMCwxLDQuNDEtNC40NiwxMS44NiwxMS44NiwwLDAsMSwxMi4wNywwLDEyLjU0LDEyLjU0LDAsMCwxLDQuNDMsNC40NiwxMS43NSwxMS43NSwwLDAsMSwwLDEyLjA2LDEyLjI2LDEyLjI2LDAsMCwxLTQuNDMsNC4zOSwxMiwxMiwwLDAsMS0xMi4wOSwwLDEyLjE2LDEyLjE2LDAsMCwxLTQuMzktNC4zOUExMiwxMiwwLDAsMSwyNzEuNzksMTYuNjJaTTI3NiwyNi40M2E3LjI3LDcuMjcsMCwwLDAsMi42NywyLjc1LDcuMTQsNy4xNCwwLDAsMCwzLjc0LDEsNi43NSw2Ljc1LDAsMCwwLDMuNjQtMSw3LjE3LDcuMTcsMCwwLDAsMi41Ny0yLjczLDguMjIsOC4yMiwwLDAsMCwwLTcuNjhBNy40Miw3LjQyLDAsMCwwLDI4NiwxNmE3LjIxLDcuMjEsMCwwLDAtNy4zNywwQTcuNTEsNy41MSwwLDAsMCwyNzYsMTguNzdhNy45LDcuOSwwLDAsMC0xLDMuODZBNy41OCw3LjU4LDAsMCwwLDI3NiwyNi40M1oiLz48cGF0aCBpZD0iUGF0aF8xMiIgZGF0YS1uYW1lPSJQYXRoIDEyIiBjbGFzcz0iY2xzLTEiIGQ9Ik0zMDMuODgsMjcuODVhNS40Niw1LjQ2LDAsMCwwLDEuODEsMS42Nyw0Ljc1LDQuNzUsMCwwLDAsMi40MS42NCw1LjEzLDUuMTMsMCwwLDAsMi41NC0uNjQsNSw1LDAsMCwwLDEuODItMS42Nyw0LDQsMCwwLDAsLjY2LTIuMTZWMTAuNzZoNC42djE1YTguNDIsOC40MiwwLDAsMS0xLjI5LDQuNTgsOC44Niw4Ljg2LDAsMCwxLTMuNDksMy4xOSwxMC44MiwxMC44MiwwLDAsMS05LjY3LDAsOC43OCw4Ljc4LDAsMCwxLTMuNDYtMy4xOSw4LjUxLDguNTEsMCwwLDEtMS4yNy00LjU4di0xNWg0LjY3VjI1LjY5QTQsNCwwLDAsMCwzMDMuODgsMjcuODVaIi8+PHBhdGggaWQ9IlBhdGhfMTMiIGRhdGEtbmFtZT0iUGF0aCAxMyIgY2xhc3M9ImNscy0xIiBkPSJNMzQ0LjY4LDEwLjc2VjM1LjQxaC0uMTNMMzI4LDIwLjQ1bC4xLDE0aC00LjczVjkuODNoLjE5TDM0MC4wOCwyNSwzNDAsMTAuNzZaIi8+PHBhdGggaWQ9IlBhdGhfMTQiIGRhdGEtbmFtZT0iUGF0aCAxNCIgY2xhc3M9ImNscy0xIiBkPSJNMzUwLjc5LDEwLjc2aDcuMDhhMTQuMzgsMTQuMzgsMCwwLDEsNy40NiwxLjc2LDEwLjYxLDEwLjYxLDAsMCwxLDQuMjcsNC41MywxMy41MiwxMy41MiwwLDAsMSwxLjMzLDYsMTEuMjIsMTEuMjIsMCwwLDEtMS42MSw2QTEwLjc5LDEwLjc5LDAsMCwxLDM2NSwzM2ExMi43MywxMi43MywwLDAsMS02LDEuNGgtOC4yNFptNy40MywxOS4xOEE4LjMzLDguMzMsMCwwLDAsMzY0LDI4LjA3YTYuNzUsNi43NSwwLDAsMCwyLjEzLTUuMzdBNy42Nyw3LjY3LDAsMCwwLDM2NSwxOC4yYTYuMjMsNi4yMywwLDAsMC0yLjczLTIuMzIsNy42Niw3LjY2LDAsMCwwLTMtLjY0aC0zLjc5djE0LjdaIi8+PHBhdGggaWQ9IlBhdGhfMTUiIGRhdGEtbmFtZT0iUGF0aCAxNSIgY2xhc3M9ImNscy0xIiBkPSJNMzgyLjg3LDE0Ljc4YTQuMDgsNC4wOCwwLDAsMC0yLjQuNjIsMi4wOCwyLjA4LDAsMCwwLS44NSwxLjgzLDIuNDIsMi40MiwwLDAsMCwxLjI0LDIsMTUsMTUsMCwwLDAsMy4yOSwxLjYyLDE0LjM5LDE0LjM5LDAsMCwxLDIuODcsMS40LDYuNCw2LjQsMCwwLDEsMiwyLjE3LDcsNywwLDAsMSwuNzgsMy41MSw2LjM2LDYuMzYsMCwwLDEtLjk0LDMuNEE2LjU5LDYuNTksMCwwLDEsMzg2LDMzLjc4YTkuNjgsOS42OCwwLDAsMS00LjM3LjkyLDE0LjM4LDE0LjM4LDAsMCwxLTQuMjItLjYzLDEzLjE3LDEzLjE3LDAsMCwxLTMuODktMS45MWwyLjA2LTMuNjRhMTEuMDUsMTEuMDUsMCwwLDAsMi44LDEuNDgsOC4wOCw4LjA4LDAsMCwwLDIuODMuNTgsNSw1LDAsMCwwLDIuNTctLjYzLDIuMTQsMi4xNCwwLDAsMCwxLjEtMnEwLTEuODMtMy40NS0zLjE4YTMwLjE1LDMwLjE1LDAsMCwxLTMuMzctMS41NSw3LDcsMCwwLDEtMi4zNC0yLjEyLDUuOSw1LjksMCwwLDEtMS0zLjQ4LDYuNDUsNi40NSwwLDAsMSwyLTQuOTIsOC4xOCw4LjE4LDAsMCwxLDUuMzYtMiwxMy43NCwxMy43NCwwLDAsMSw0LjQxLjZBMTQuOTIsMTQuOTIsMCwwLDEsMzkwLDEyLjkybC0xLjc3LDMuNTdhMTEuNDksMTEuNDksMCwwLDAtNS4zNy0xLjcxWiIvPjxwYXRoIGlkPSJQYXRoXzE2IiBkYXRhLW5hbWU9IlBhdGggMTYiIGNsYXNzPSJjbHMtMSIgZD0iTTIxLjU3LDM5LjYxYTE2LjI5LDE2LjI5LDAsMCwxLDAtMzIuMzVWMGEyMy41MSwyMy41MSwwLDAsMCwwLDQ2Ljg2WiIvPjxwYXRoIGlkPSJQYXRoXzE3IiBkYXRhLW5hbWU9IlBhdGggMTciIGNsYXNzPSJjbHMtMSIgZD0iTTI1LjM3LDBWNy4yNkExNi4yNywxNi4yNywwLDAsMSwzMi43LDM2LjdWMjYuMDdIMjUuMzd2MjAuOEEyMy41MiwyMy41MiwwLDAsMCwyNS4zNywwWiIvPjwvZz48L2c+PC9zdmc+');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('Creative Grounds');
        $style->setDescription('Huistlijl Creative Grounds');
        $style->setCss('

        .checkinFont {
            color: #ffffff;
        }

        .background {
            background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4gPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJMYWFnXzEiIGRhdGEtbmFtZT0iTGFhZyAxIiB2aWV3Qm94PSIwIDAgNDgwIDQ4MCI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOm5vbmU7fS5jbHMtMntmaWxsOiNlNjQ3NDE7fS5jbHMtM3tmaWxsOiMwMTAxMDE7fS5jbHMtNHtmaWxsOiNlZDc4YjU7fS5jbHMtNXtmaWxsOiM1NDExN2M7fS5jbHMtNntmaWxsOiMwMDVjNzk7fS5jbHMtN3tmaWxsOiM2Mjg0OTQ7fS5jbHMtOHtmaWxsOiM1Nzk5NzI7fS5jbHMtOXtmaWxsOiNkZmE0YTA7fS5jbHMtMTB7ZmlsbDojODMyZjMyO30uY2xzLTExe2ZpbGw6I2E0N2YzMzt9LmNscy0xMntmaWxsOiM4NGE0OWM7fS5jbHMtMTN7ZmlsbDojZGViYTc2O30uY2xzLTE0e2ZpbGw6IzU4ODA3Nzt9LmNscy0xNXtmaWxsOiNhY2E3OWE7fS5jbHMtMTZ7ZmlsbDojMDAyODRjO30uY2xzLTE3e2ZpbGw6I2U5Yzg0Yjt9LmNscy0xOHtmaWxsOiNjNzg2ODE7fTwvc3R5bGU+PC9kZWZzPjxyZWN0IGNsYXNzPSJjbHMtMSIgd2lkdGg9IjQ4MCIgaGVpZ2h0PSI0ODAiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTIiIHg9Ijc5LjkxIiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTMiIHg9IjE1OS44NCIgeT0iMTU5LjgxIiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTQiIHg9IjE1OS44NCIgeT0iNzkuNTgiIHdpZHRoPSI4MC4xMiIgaGVpZ2h0PSI4MC4wMiI+PC9yZWN0PjxyZWN0IGNsYXNzPSJjbHMtNSIgeD0iLTAuNCIgeT0iMTU5LjcxIiB3aWR0aD0iODAuNDYiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTYiIHg9Ii0wLjIxIiB3aWR0aD0iODAuNDYiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cG9seWxpbmUgY2xhc3M9ImNscy03IiBwb2ludHM9Ijc5LjcyIDgwLjAyIC0wLjQgODAuMDIgLTAuNCAwIj48L3BvbHlsaW5lPjxyZWN0IGNsYXNzPSJjbHMtOCIgeD0iMTYwLjA4IiB5PSItMC4wNSIgd2lkdGg9IjgwLjAyIiBoZWlnaHQ9IjgwLjEyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxNjAuMDggMjQwLjEpIHJvdGF0ZSgtOTApIj48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtOSIgcG9pbnRzPSIyMzkuOTYgMCAyMzkuOTYgODAuMDIgMTU5Ljg0IDgwLjAyIj48L3BvbHlsaW5lPjxyZWN0IGNsYXNzPSJjbHMtOSIgeD0iODAuMDYiIHk9Ijc5LjY4IiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cG9seWxpbmUgY2xhc3M9ImNscy0xMCIgcG9pbnRzPSIxNjAuMTggMTU5Ljk1IDgwLjA2IDE1OS45NSA4MC4wNiA3OS45MiI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTExIiB4PSItMC4xOCIgeT0iNzkuODEiIHdpZHRoPSI3OS42OCIgaGVpZ2h0PSI4MC4xMiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTgwLjIgMTU5LjUzKSByb3RhdGUoLTkwKSI+PC9yZWN0PjxyZWN0IGNsYXNzPSJjbHMtMTIiIHg9IjgwLjExIiB5PSIxNTkuOSIgd2lkdGg9IjgwLjAyIiBoZWlnaHQ9IjgwLjEyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtNzkuODMgMzIwLjA4KSByb3RhdGUoLTkwKSI+PC9yZWN0Pjxwb2x5bGluZSBjbGFzcz0iY2xzLTEzIiBwb2ludHM9IjgwLjA2IDc5LjU4IDgwLjA2IDE1OS43MSAtMC4xOSAxNTkuNzEiPjwvcG9seWxpbmU+PHBvbHlsaW5lIGNsYXNzPSJjbHMtMTQiIHBvaW50cz0iMTYwLjA4IDE1OS45NSAxNjAuMDggMjM5Ljk3IDc5Ljk2IDIzOS45NyI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTE1IiB4PSIyMzkuOTEiIHk9Ijc5Ljg4IiB3aWR0aD0iODAuMDIiIGhlaWdodD0iODAuMTIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDE1OS45OSAzOTkuODYpIHJvdGF0ZSgtOTApIj48L3JlY3Q+PHJlY3QgY2xhc3M9ImNscy0zIiB4PSI0MDAuNCIgeT0iLTAuMSIgd2lkdGg9Ijc5LjkyIiBoZWlnaHQ9IjgwLjEyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg0MDAuNCA0ODAuMzIpIHJvdGF0ZSgtOTApIj48L3JlY3Q+PHJlY3QgY2xhc3M9ImNscy00IiB4PSIzMjAuMTgiIHk9Ii0wLjIiIHdpZHRoPSI3OS45MiIgaGVpZ2h0PSI4MC4zMiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzIwLjE4IDQwMC4xKSByb3RhdGUoLTkwKSI+PC9yZWN0PjxyZWN0IGNsYXNzPSJjbHMtNSIgeD0iMzk5Ljg2IiB5PSI0MDAuNzEiIHdpZHRoPSI4MC40NiIgaGVpZ2h0PSI4MC40NiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTAuODUgODgxLjAzKSByb3RhdGUoLTkwKSI+PC9yZWN0PjxyZWN0IGNsYXNzPSJjbHMtNiIgeD0iMjM5LjY3IiB5PSIxNTkuOSIgd2lkdGg9IjgwLjAyIiBoZWlnaHQ9IjgwLjEyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3OS43MiA0NzkuNjQpIHJvdGF0ZSgtOTApIj48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtNyIgcG9pbnRzPSIzMTkuNzQgMTU5Ljk1IDMxOS43NCAyMzkuOTcgMjM5LjYyIDIzOS45NyI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTE2IiB4PSIyMzkuNjIiIHdpZHRoPSI4MC4xMiIgaGVpZ2h0PSI4MC4wMiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNTU5LjM2IDgwLjAyKSByb3RhdGUoMTgwKSI+PC9yZWN0Pjxwb2x5bGluZSBjbGFzcz0iY2xzLTE3IiBwb2ludHM9IjIzOS44MSAwIDMyMC4xNyAwIDMyMC4xNyA3OS45MiI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTE4IiB4PSIzMjAuMDgiIHk9Ijc5LjgyIiB3aWR0aD0iODAuMDIiIGhlaWdodD0iODAuMjIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDI0MC4xNiA0ODAuMDMpIHJvdGF0ZSgtOTApIj48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtMTAiIHBvaW50cz0iNDAwLjI1IDc5LjkyIDQwMC4yNSAxNTkuOTUgMzIwLjEzIDE1OS45NSI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTExIiB4PSIzMTkuNzQiIHk9IjE1OS43NCIgd2lkdGg9IjgwLjEyIiBoZWlnaHQ9IjgwLjQzIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3MTkuNiAzOTkuOTEpIHJvdGF0ZSgxODApIj48L3JlY3Q+PHJlY3QgY2xhc3M9ImNscy0xMiIgeD0iNDAwLjIiIHk9IjgwLjAyIiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMDIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDg4MC41MiAyNDAuMDcpIHJvdGF0ZSgxODApIj48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtMTMiIHBvaW50cz0iMzE5Ljc0IDE1OS43NCAzOTkuODYgMTU5Ljc0IDM5OS44NiAyMzkuNzYiPjwvcG9seWxpbmU+PHBvbHlsaW5lIGNsYXNzPSJjbHMtOCIgcG9pbnRzPSI0MDAuMyA3OS45MiA0ODAuNDIgNzkuOTIgNDgwLjQyIDE1OS45NSI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTE1IiB4PSI3OS45NiIgeT0iMjM5Ljc4IiB3aWR0aD0iODAuMDUiIGhlaWdodD0iODAuMTIiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTE3IiB4PSItMC40IiB5PSI0MDAuMDgiIHdpZHRoPSI4MC40NyIgaGVpZ2h0PSI3OS43OCI+PC9yZWN0PjxyZWN0IGNsYXNzPSJjbHMtNCIgeD0iLTAuNCIgeT0iMjM5Ljc4IiB3aWR0aD0iODAuMzYiIGhlaWdodD0iODAuMTIiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTUiIHg9IjE1OS4yOSIgeT0iMzk5Ljc0IiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMTIiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTYiIHg9IjE2MC4wMSIgeT0iMjM5LjU5IiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cG9seWxpbmUgY2xhc3M9ImNscy03IiBwb2ludHM9IjI0MC4xMyAzMTkuNjEgMTYwLjAxIDMxOS42MSAxNjAuMDEgMjM5LjU5Ij48L3BvbHlsaW5lPjxyZWN0IGNsYXNzPSJjbHMtNiIgeD0iLTAuMjUiIHk9IjMxOS43NSIgd2lkdGg9IjgwLjE4IiBoZWlnaHQ9IjgwLjQ3IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgzOTkuODIgMzIwLjE1KSByb3RhdGUoOTApIj48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtOSIgcG9pbnRzPSItMC40IDM5OS45MyAtMC40IDMxOS45IDc5LjgxIDMxOS45Ij48L3BvbHlsaW5lPjxyZWN0IGNsYXNzPSJjbHMtOSIgeD0iODAuMDciIHk9IjMxOS45MSIgd2lkdGg9IjgwLjEyIiBoZWlnaHQ9IjgwLjAyIj48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtMTAiIHBvaW50cz0iMTYwLjA4IDM5OS45MiA3OS45NiAzOTkuOTIgNzkuOTYgMzE5LjkiPjwvcG9seWxpbmU+PHJlY3QgY2xhc3M9ImNscy0xMSIgeD0iMTU5Ljg5IiB5PSIzMTkuOTEiIHdpZHRoPSI4MC4wMiIgaGVpZ2h0PSI3OS40NCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTE1OS43MiA1NTkuNTMpIHJvdGF0ZSgtOTApIj48L3JlY3Q+PHJlY3QgY2xhc3M9ImNscy0xMiIgeD0iNzkuOTIiIHk9IjM5OS44MyIgd2lkdGg9Ijc5Ljk0IiBoZWlnaHQ9IjgwLjEyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMzIwLjAxIDU1OS43Nykgcm90YXRlKC05MCkiPjwvcmVjdD48cG9seWxpbmUgY2xhc3M9ImNscy0xMyIgcG9pbnRzPSIyMzkuNjIgMzE5LjYxIDIzOS42MiAzOTkuOTMgMTYwLjE5IDM5OS45MyI+PC9wb2x5bGluZT48cG9seWxpbmUgY2xhc3M9ImNscy0xNCIgcG9pbnRzPSIxNTkuOTQgMzk5Ljc0IDE1OS45NCA0NzkuODYgNzkuNzIgNDc5Ljg2Ij48L3BvbHlsaW5lPjxyZWN0IGNsYXNzPSJjbHMtMTUiIHg9IjMxOS43OSIgeT0iMzE5LjkxIiB3aWR0aD0iODAuMDIiIGhlaWdodD0iODAuMTIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDcxOS43NyAwLjE3KSByb3RhdGUoOTApIj48L3JlY3Q+PHJlY3QgY2xhc3M9ImNscy0yIiB4PSIyMzkuNDUiIHk9IjM5OS43MSIgd2lkdGg9IjgwLjI2IiBoZWlnaHQ9IjgwLjMzIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3MTkuNDUgMTYwLjI5KSByb3RhdGUoOTApIj48L3JlY3Q+PHJlY3QgY2xhc3M9ImNscy00IiB4PSI0MDAuMTgiIHk9IjE1OS42OSIgd2lkdGg9IjgwLjAyIiBoZWlnaHQ9IjgwLjYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDY0MC4xOCAtMjQwLjIpIHJvdGF0ZSg5MCkiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTUiIHg9IjIzOS41MSIgeT0iMjQwIiB3aWR0aD0iODAuMjYiIGhlaWdodD0iODAuMTIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDU1OS43MSAwLjQyKSByb3RhdGUoOTApIj48L3JlY3Q+PHJlY3QgY2xhc3M9ImNscy02IiB4PSIzMTkuNzkiIHk9IjIzOS44OCIgd2lkdGg9IjgwLjAyIiBoZWlnaHQ9IjgwLjEyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2MzkuNzQgLTc5Ljg2KSByb3RhdGUoOTApIj48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtNyIgcG9pbnRzPSIzMTkuNzQgMzE5Ljk1IDMxOS43NCAyMzkuOTMgMzk5Ljg2IDIzOS45MyI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTciIHg9IjMxOS43NCIgeT0iMzk5Ljg2IiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cG9seWxpbmUgY2xhc3M9ImNscy0xMCIgcG9pbnRzPSIzOTkuODYgNDgwIDMxOS43NCA0ODAgMzE5Ljc0IDM5OS45OCI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTkiIHg9IjQwMC40MiIgeT0iMzIwLjI1IiB3aWR0aD0iODAuMDIiIGhlaWdodD0iODAuMTIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDgwMC43NCAtODAuMTMpIHJvdGF0ZSg5MCkiPjwvcmVjdD48cG9seWxpbmUgY2xhc3M9ImNscy0xMCIgcG9pbnRzPSIzOTkuODkgNDAwLjMyIDM5OS44OSAzMTkuNTYgNDgwLjAxIDMxOS41NiI+PC9wb2x5bGluZT48cmVjdCBjbGFzcz0iY2xzLTExIiB4PSI0MDAuMjMiIHk9IjIzOS45IiB3aWR0aD0iODAuMTIiIGhlaWdodD0iODAuMDIiPjwvcmVjdD48cmVjdCBjbGFzcz0iY2xzLTEyIiB4PSIyMzkuNTgiIHk9IjMyMC4xOSIgd2lkdGg9IjgwLjE2IiBoZWlnaHQ9Ijc5Ljc4Ij48L3JlY3Q+PHBvbHlsaW5lIGNsYXNzPSJjbHMtMTMiIHBvaW50cz0iNDgwLjExIDMxOS45MiAzOTkuODYgMzE5LjkyIDM5OS44NiAyMzkuOSI+PC9wb2x5bGluZT48cG9seWxpbmUgY2xhc3M9ImNscy0xNCIgcG9pbnRzPSIzMTkuNyAzOTkuOTYgMjM5LjQxIDM5OS45NiAyMzkuNDEgMzE5LjU2Ij48L3BvbHlsaW5lPjwvc3ZnPiA=");
        }

        ');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        // Dan zuidrecht secifieke dingen
        $id = Uuid::fromString('c571bdad-f34c-4e24-94e7-74629cfaccc9');
        $organization = new Organization();
        $organization->setName('Checking platform');
        $organization->setDescription('Checking platform');
        $organization->setRsin('');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'55247f46-77d4-438e-90f1-524595767c42']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('1d49efd7-7f37-4ea9-bca7-dd098408c0b9');
        $favicon = new Image();
        $favicon->setName('CheckIN Favicon');
        $favicon->setDescription('CheckIN Favicon');
        $favicon->setBase64('data:image/gif;base64,R0lGODlhugCtALMKAEGOtL/Z5oCzzWGhwTGErt/s8s/j7BFxoe/2+QFom////wAAAAAAAAAAAAAAAAAAACH5BAEAAAoALAAAAAC6AK0AAAT/MKRJq704U8W7/2AojmRpnminrWwmtTCcznRt32qsu3t/4cCgsOYrJl7G3nDJbHKSPSQ05qxaidOYNMu6er8jLmwrzoDP6DKLrLag3962hi2fwO/OOoZex/uHehd8cn+FOIEWg22GjDSIFYpqjZMnjxSRAJSamyQAay2ZnKKjniuYo6ibpXOgqa6Nqzwsoa+1eLF7rba7b7iCurzBXr6JwMLHTcSQxsjNQcqXzM7TNdATp9TZ1Z+z2t4p1kfS3+Qf4djl6ebcK7Tq7+fj79/x3fPw7Bru9+T17UMCAgocSLCgwYAFRhxEKKLAQgEjHD6ceHCIP32A2gQIM0fEoBGR/3xYzJdh3w05G0WY8rgCJCEhF0tmVJMyxMoQH1kugkkSg0kbKDm60GmGaJmRpuQ50ih0j9EfT7kgZWUvSFCVHXG2jJplqqx/Qq7azAoip9adz1ggCMC2rVu2BmaWqQniZtmtZyUJMfC2Lxyxdcl+MHsXrbcVBAAoXrzYLgjGkAEMODgAb+GSkRUTsKzN8QfPKIy41DC66DfQOYZiEcl1Q2s75FA/EZxC9OsEpTGUk62ANwnbeXXf3k3bg++mO3JDDb78cPHUTlcrGU799PPZqpeyZu6muvPsgcHXLqK8O/cKxMUbv14C+GXh511bzzD54HERmTVz9jBoYWXSsTHFBP9hg70031xNEMifgd8hOOB+HYQ03YFi0CWEghEy2JmAS2DIgYTJBUhTghB+qGE2gF1YogIg6pCegx2u2CIVIsI4hIcsnkhNfjz2uFhcIlBk0AA9jmCAj0hmxs8X7i35TpNOpgNllDWGSKU6U1654XZaVulily9aCWaDYo6Jh5BoCpRYfis8FJGbDcHpZIrrcVkggPHBNieH4U34XnN3mrYkndCVuSCef5o3KJ+fkeddoPAtOiJWdh4qKKSA3kModn5iqqin6EW5aW+O5onbo5oyWmenlkYKqnyS2thopRki+qqesV6wZpKM1WfQrpBtZmurF/i3opTs/XYdjjPKIGr/ssglgmqteu2pXiXLyqjjk9BSGl2ioZqaJZbdjnVtjsNSe9Sz57aXbbomGsbPfeZ+e+up4paaq7TSCTJtvNXuCwlQ715KrFTkPLSCr2kKsDBlPBJgrD75CWswNZZ0dZu28DqT8RTl0WhqmB+zqq6hJ3+KYsnjNovrvSSzLDK4zo7spcw109xCyLBuifOX+V4MsKsr/wy0zl3867HRR9/LsdDO8Cq1j4hV7N/UjBlZpJlWFUw0167IhiPYooh9LNmbmN0x2ml7nSnbZbutMtycqA013ZPY/TXelOj9Nt9BNixkQt76a3MIEgk+UcxTWLiq4UjzDAXjUDheKL+Rb6yv/88VRjvw4UiP28yofs89tBiUJ2E5p5DDrDmt05Aud7ihb160rI9j7nrQJseu6uWfZ847yr5PWm/rB9PutO0YawAsZLz1yPBARPIoeQIRn30Mb/T2+XcJzGovDPflem86+E/vvXS73c+qPgnhr40M+e0qe/f1+N98ief793s+/On73ujY077cKQ8F8bvf9ghYPvcJMH+g45zuHDjB0MhPaWObHwPrx7+XITCA/9MgfRbCG4Vd0FQTU+D4fse6pn1QXrfrXOFceAKXJQ0M6ACC7GCHPhjaICY+kYsMj0dDE9hQfCYA4gV+4r8srI5UPASgD7eRlKrokIVQ7F0PA4YDJdtagInawR3wcpaCI54wiT1ZohC58ETRXc+NKPBiBcA4gx1qUYpcvIEcKUBHcGANSUAKwR8VY4MjDXJraakiWACXij1OoI+MZIQjsRfJRqbxi5VExSQhmUk/bLKTovgkKFVxyTmOkpSKxMgpKSHKVcKilHx05SRaKctC0LKWnoTlI3FpiFvyEg6+/CUagilMMBCzmMPQZQIOcMjIgLKZkDmAMteVyY+Z8Y5ws2bJQKnNj3EzY9ckHt66mbFvWiKcRRwnOLfZSXJawpyPQOfMIunOR8ATEfIkIyM/FgEAOw==');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('CheckIn');
        $style->setDescription('Huistlijl Gemeente Zuid-Drecht');
        $style->setCss('
        :root {
                --primary: #01689b;
                --primary-color: white;
                --background: #01689b;
                --secondary: #cce0f1;
                --secondary-color: #2b2b2b;

                --menu: #01689b;
                --menu-over: #3669A5;
                --menu-color: white;
                --footer: #01689b;
                --footer-color: white;
         }


         .main {
            padding-top: 0px;
        }

        h1, h2 {
            font-family: \'Lobster\', cursive;
        }

        .footer {
            padding-top: 0px;
        }
        ');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $configuration = new Configuration();
        $configuration->setName('checkin.conduction.nl configuration');
        $configuration->setDescription('De configuratie van de stage applicatie');
        $configuration->setOrganization($organization);
        $configuration->setConfiguration(
            [
                'mainMenu'                         => 'f0faccbd-3067-45fb-9ab7-2938fbbbf492',
                'home'                             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'513ee2e3-cf32-4f1e-a85e-ccbe5743c418']),
                'footer1'                          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'3895915c-a992-462e-848d-3be73a954d51']),
                'footer2'                          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'93477f57-c092-4609-b9ae-8767495fead1']),
                'footer3'                          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'d44e0e0e-6c5b-461a-91df-0a77d44e2efb']),
                'footer4'                          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'11c2c0eb-125c-4546-835f-26f30d924b06']),
                'Horeca ondernemers'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'dde7b026-de93-4bed-b26d-5df2150244d1']),
                //'nieuws'                => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'f2729540-2740-4fbf-98ae-f0a069a1f43f']),
                //'newsimg'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'b0e3e803-2cb6-41ed-ab32-d6e5451c119d']),
                //'headerimg'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'0863d15c-286e-4ec4-90f6-27cebb107aa9']),
                'userPage'              => 'me',
                'invoiceTemplate'       => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'4f313197-1321-4e6d-a206-d5d80bb11b07']),
                'login'                 => ['user'=>true, 'facebook'=>true, 'gmail'=>true],
                'header'                => false,
                'stickyMenu'            => true,
                'newsGroup'             => '1024',
                'onboardId'             => 'fdb7186c-0ce9-4050-bd6d-cf83b0c162eb',
            ]
        );
        $manager->persist($configuration);

        $id = Uuid::fromString('31a2ad29-ee03-4aa9-be81-abf1fda7bbcc');
        $application = new Application();
        $application->setName('CheckIn');
        $application->setDescription('Website voor checkin.conduction.nl');
        $application->setDomain('checkin.conduction.nl');
        $application->setStyle($style);
        $application->setOrganization($organization);
        $application->setDefaultConfiguration($configuration);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Menu
        $id = Uuid::fromString('f0faccbd-3067-45fb-9ab7-2938fbbbf492');
        $menu = new Menu();
        $menu->setName('CheckIn Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setOrder(1);
        $menuItem->setIcon('fas fa-home');
        $menuItem->setType('slug');
        $menuItem->setHref('/');
        $menuItem->setMenu($menu);
        $menuItem->setTranslatableLocale('nl'); // change locale
        $menuItem->setName('Home');
        $menuItem->setDescription('Ga terug naar de home page');
        $manager->persist($menuItem);
        $manager->flush();
        $menuItem->setTranslatableLocale('en'); // change locale
        $menuItem->setName('Home');
        $menuItem->setDescription('Go back to the main page');
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/ondernemers');
        $menuItem->setMenu($menu);
        $menuItem->setTranslatableLocale('nl'); // change locale
        $menuItem->setName('Voor ondernemers');
        $menuItem->setDescription('Registreer uw onderneming');
        $manager->persist($menuItem);
        $manager->flush();
        $menuItem->setTranslatableLocale('en'); // change locale
        $menuItem->setName('For organizations');
        $menuItem->setDescription('Register your organization');
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/about');
        $menuItem->setMenu($menu);
        $menuItem->setTranslatableLocale('nl'); // change locale
        $menuItem->setName('Hoe werkt het');
        $menuItem->setDescription('Hoe werkt checkin');
        $manager->persist($menuItem);
        $manager->flush();
        $menuItem->setTranslatableLocale('en'); // change locale
        $menuItem->setName('How does it work?');
        $menuItem->setDescription('Register your organization');
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/privacy');
        $menuItem->setMenu($menu);
        $menuItem->setTranslatableLocale('nl'); // change locale
        $menuItem->setName('Privacy');
        $menuItem->setDescription('Wie zitten achter CheckIn');
        $manager->persist($menuItem);
        $manager->flush();
        $menuItem->setTranslatableLocale('en'); // change locale
        $menuItem->setName('Privacy');
        $menuItem->setDescription('Who are behind checking');
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setOrder(5);
        $menuItem->setType('slug');
        $menuItem->setHref('/proclaimer');
        $menuItem->setMenu($menu);
        $menuItem->setTranslatableLocale('nl'); // change locale
        $menuItem->setName('Voorwaarden');
        $menuItem->setDescription('Algemeene voorwaarden');
        $manager->persist($menuItem);
        $manager->flush();
        $menuItem->setTranslatableLocale('en'); // change locale
        $menuItem->setName('Terms and conditions');
        $menuItem->setDescription('Terms and conditions');
        $manager->persist($menuItem);

        // Template groups
        // E-mails
        $groupEmails = new TemplateGroup();
        $groupEmails->setOrganization($organization);
        $groupEmails->setApplication($application);
        $groupEmails->setName('E-mails');
        $groupEmails->setDescription('E-mails die verstuurd worden');
        $manager->persist($groupEmails);
        $manager->flush();
        $groupEmails->setTranslatableLocale('en'); // change locale
        $groupEmails->setName('E-mails');
        $groupEmails->setDescription('E-mails that are send out');
        $manager->persist($groupEmails);

        // Invoices
        $groupInvoices = new TemplateGroup();
        $groupInvoices->setOrganization($organization);
        $groupInvoices->setApplication($application);
        $groupInvoices->setName('Facturen');
        $groupInvoices->setDescription('Factuur templates die worden ingevuld aan de hand van facturen');
        $manager->persist($groupInvoices);
        $manager->flush();
        $groupInvoices->setTranslatableLocale('en'); // change locale
        $groupInvoices->setName('Invoices');
        $groupInvoices->setDescription('Invoice templates that are filled in using invoices');
        $manager->persist($groupInvoices);

        // E-mail templates
        $id = Uuid::fromString('60314e20-3760-4c17-9b18-3a99a11cbc5f');
        $template = new Template();
        $template->setTranslatableLocale('nl'); // change locale
        $template->setTemplateEngine('twig');
        $template->setName('Reset');
        $template->setTitle('Wachtwoord resetten');
        $template->setDescription('Mail voor het resetten van je wachtwoord');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/emails/reset.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        // E-mail templates
        $id = Uuid::fromString('2ca5b662-e941-46c9-ae87-ae0c68d0aa5d');
        $template = new Template();
        $template->setTranslatableLocale('nl'); // change locale
        $template->setTemplateEngine('twig');
        $template->setName('Welkom');
        $template->setTitle('Welkom bij checkin!');
        $template->setDescription('Bevestiging dat u een verzoek heeft ingediend');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/emails/welkom.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('07075add-89c7-4911-b255-9392bae724b3');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Uw accountgegevens');
        $template->setTitle('Uw wachtwoord voor checkin');
        $template->setDescription('Uw wachtwoord voor uw account op checking.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/emails/wachtwoord.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-wachtwoord');
        $slug->setSlug('e-mail-wachtwoord');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('6f4dbb62-5101-4863-9802-d08e0f0096d2');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Verzoek tot deelname');
        $template->setTitle('Verzoek tot deelname van checkin met uw email adres');
        $template->setDescription('Er is zojuist een poging gedaan om deel te nemen aan checkin met uw email adres');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/emails/usernameExists.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-usernameExists');
        $slug->setSlug('e-mail-usernameExists');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('cdad2591-c288-4f54-8fe5-727f67e65949');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Hoog aantal checkins');
        $template->setTitle('Een accommodatie heeft een hoog aantal checkins');
        $template->setDescription('Een van uw accommodaties heeft een hoog aantal checkins bereikt!');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/emails/highCheckinCount.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-highCheckinCount');
        $slug->setSlug('e-mail-highCheckinCount');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('f073f5b5-2853-4cca-8de4-9889f21aa6a2');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Maximum aantal checkins');
        $template->setTitle('Een accommodatie heeft het maximum aantal checkins bereikt');
        $template->setDescription('Een van uw accommodaties heeft het maximum aantal checkins bereikt!');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/emails/maxCheckinCount.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-maxCheckinCount');
        $slug->setSlug('e-mail-maxCheckinCount');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('4016c529-cf9e-415e-abb1-2aba8bfa539e');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Verzoek geannuleerd');
        $template->setTitle('U heeft uw verzoek geannuleerd');
        $template->setDescription('Bevestiging dat u een verzoek heeft geannuleerd');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/emails/annulering.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-annulering');
        $slug->setSlug('e-mail-annulering');
        $manager->persist($slug);
        $manager->flush();

        // Invoice templates
        $id = Uuid::fromString('4f313197-1321-4e6d-a206-d5d80bb11b07');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Voorbeeld Factuur');
        $template->setDescription('Een voorbeeld factuur sjabloon');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/facturen/tempVoorbeeld.html.twig', 'r'));

        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupInvoices);
        $manager->persist($template);
        $manager->flush();

        //legal templates

        $id = Uuid::fromString('4cf7ead1-18b5-40a8-8560-dbfc6368872a');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('terms_nl no container');
        $template->setTitle('terms_nl no container');
        $template->setDescription('terms_nl no container');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/legal/terms_nl.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('29d316fe-0577-4f34-98ed-a93714dcb314');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('terms_nl');
        $template->setTitle('terms_nl');
        $template->setDescription('terms_nl');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/legal/terms_nl_container.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('terms-nl');
        $slug->setSlug('terms-nl');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('c7f92ce6-8fca-4cb0-957b-6282375fa3de');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('gdrp_nl no container');
        $template->setTitle('gdrp_nl no container');
        $template->setDescription('gdrp_nl no container');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/legal/gdrp_nl.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('a3c728a8-b160-4ba3-a973-32c981be0dfd');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('gdrp_nl');
        $template->setTitle('gdrp_nl');
        $template->setDescription('gdrp_nl');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/legal/gdrp_nl_container.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('gdrp-nl');
        $slug->setSlug('gdrp-nl');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('e583d7bc-3774-4bb1-a413-b0f25e6facc4');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('privacy-nl no container');
        $template->setTitle('privacy-nl no container');
        $template->setDescription('privacy-nl no container');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/legal/privacy_nl.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('57c7100d-dce7-4b99-b950-d16fcb017a84');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('privacy-nl');
        $template->setTitle('privacy-nl');
        $template->setDescription('privacy-nl');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/legal/privacy_nl_container.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('privacy-nl');
        $slug->setSlug('privacy-nl');
        $manager->persist($slug);
        $manager->flush();

        // Pages
        $id = Uuid::fromString('513ee2e3-cf32-4f1e-a85e-ccbe5743c418');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('CheckIng.nu Home');
        $template->setDescription('Homepage voor CheckIn.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/index.html.twig', 'r'));
        $manager->persist($template);
        $manager->flush();
        $template->setTranslatableLocale('en'); // change locale
        $template->setName('CheckIng.nu Home');
        $template->setDescription('Homepage voor CheckIn.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/index.html.twig', 'r'));
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('8e8007b8-e3c0-4253-ac57-09680789a351');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Organisatie');
        $template->setDescription('Informatie voor organisaties');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/ondernemers.html.twig', 'r'));
        $manager->persist($template);
        $template->setId($id);
        $manager->flush();
        $template->setTranslatableLocale('en'); // change locale
        $template->setName('Organization');
        $template->setDescription('Information for organizations');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/ondernemers.html.twig', 'r'));
        $manager->persist($template);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('ondernemers');
        $slug->setSlug('ondernemers');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('8c0d7c28-a4bc-4d9e-b18b-ae3fc933c311');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Horeca');
        $template->setDescription('Informatie voor horeca');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/horeca.html.twig', 'r'));
        $manager->persist($template);
        $template->setId($id);
        $manager->flush();
        $template->setTranslatableLocale('en'); // change locale
        $template->setName('Horeca');
        $template->setDescription('Information for organizations');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/horeca.html.twig', 'r'));
        $manager->persist($template);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('horeca');
        $slug->setSlug('horeca');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('567f97d8-89dd-4ef3-8119-179ea4001a4f');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('About');
        $template->setDescription('About CheckIng.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/about.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();
        $template->setTranslatableLocale('en'); // change locale
        $template->setName('About');
        $template->setDescription('About CheckIng.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/about.html.twig', 'r'));
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('about');
        $slug->setSlug('about');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('1374e3da-b4cb-49a7-8969-6bada9f26b12');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Proclaimer');
        $template->setDescription('Proclaimer');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/proclaimer.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('proclaimer');
        $slug->setSlug('proclaimer');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('c381a552-c7b8-45d8-92f4-3f2ec5c50470');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Privacy');
        $template->setDescription('Privacy');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/privacy.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('privacy');
        $slug->setSlug('privacy');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('39c9ed21-a1b7-4610-8190-f99ccd179f0f');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('CheckIn.nu Techniek');
        $template->setDescription('Techniek page voor CheckIn.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/techniek.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('techniek');
        $slug->setSlug('techniek');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('d1e07882-e130-45da-b2ae-617c09cf0ad3');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('me');
        $template->setDescription('Homepage voor CheckIn.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/me.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('me');
        $slug->setSlug('me');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('27dfcd18-b71d-4ff1-99bb-1295a33042bf');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('tip');
        $template->setDescription('tip');
        $template->setContent('Hier komt een tip template');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('tip');
        $slug->setSlug('tip');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('a59a2fc9-ec62-4f69-a5db-5404e175bf4f');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('contact');
        $template->setDescription('contact');
        $template->setContent('Hier komt een contact template');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('contact');
        $slug->setSlug('contact');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('dde7b026-de93-4bed-b26d-5df2150244d1');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Horeca ondernemer');
        $template->setTitle('Horeca ondernemer pagina');
        $template->setDescription('Horeca ondernemer pagina');
        $template->setContent('Hier komt de horeca ondernemer pagina');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('3895915c-a992-462e-848d-3be73a954d51');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('footer1');
        $template->setDescription('footer1');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/footers/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('93477f57-c092-4609-b9ae-8767495fead1');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('footer2');
        $template->setDescription('footer2');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/footers/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('d44e0e0e-6c5b-461a-91df-0a77d44e2efb');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('footer3');
        $template->setDescription('footer3');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/footers/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('11c2c0eb-125c-4546-835f-26f30d924b06');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('footer4');
        $template->setDescription('footer4');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/footers/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('b7049936-bef1-45a1-a70e-9160f795a6cd');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('verwerkersOvereenkomst');
        $template->setDescription('verwerkersOvereenkomst');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/verwerkersOvereenkomst.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('d177a32e-3b7e-412e-b68e-a117769e5dcc');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('contact modal');
        $template->setDescription('contact modal');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/modals/contact.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('4d2dcaec-a714-4b05-8935-35ec431e9629');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('feedback modal');
        $template->setDescription('feedback modal');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/modals/feedback.html.twig', 'r'));
        $manager->persist($template);
        $manager->flush();
        $template->setTranslatableLocale('en'); // change locale
        $template->setName('feedback modal');
        $template->setDescription('feedback modal');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/modals/feedback.html.twig', 'r'));
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);
        $manager->flush();

        /*
         * Then we need some example organizations
         */

        // Zuid-Drecht
        /*
        $id = Uuid::fromString('2106575d-50f3-4f2b-8f0f-a2d6bc188222');
        $organization = new Organization();
        $organization->setName('Cafe de zotte raaf');
        $organization->setDescription('Het gezeligste dijkcafe van nederland');
        $organization->setRsin('809642451');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Zuid-Drecht
        $id = Uuid::fromString('a9398c45-7497-4dbd-8dd1-1be4f3384ed7');
        $organization = new Organization();
        $organization->setName('Restautant Goudlust');
        $organization->setDescription('In deze vormalige dijkgraaf woning geniet u van voortreffelijk eten bereid met locale ingredienten');
        $organization->setRsin('809642451');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Zuid-Drecht
        $id = Uuid::fromString('8812dc58-6bbe-4028-8e36-96f402bf63dd');
        $organization = new Organization();
        $organization->setName('Hotel Dijkzicht');
        $organization->setDescription('Gevestigd in een oud-tol huis kijkt dit prachtige hotel uit op de drechtse dijk');
        $organization->setRsin('809642451');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);
        */
    }
}
