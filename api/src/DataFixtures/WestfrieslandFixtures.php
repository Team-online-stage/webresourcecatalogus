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
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WestfrieslandFixtures extends Fixture
{
    private $params;
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'begraven.zaakonline.nl' && strpos($this->params->get('app_domain'), 'begraven.zaakonline.nl') == false &&
            $this->params->get('app_domain') != 'westfriesland.commonground.nu' && strpos($this->params->get('app_domain'), 'westfriesland.commonground.nu') == false
        ) {
            return false;
        }

        // West-Friesland
        $id = Uuid::fromString('d280c4d3-6310-46db-9934-5285ec7d0d5e');
        $westfriesland = new Organization();
        $westfriesland->setName('Westfriesland');
        $westfriesland->setDescription('Westfriese gemeenten Westfriesland');
        $westfriesland->setRsin('999990482');
        $westfriesland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $manager->persist($westfriesland);
        $westfriesland->setId($id);
        $manager->persist($westfriesland);
        $manager->flush();
        $westfriesland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $favicon = new Image();
        $id = Uuid::fromString('0923599d-5182-4a1b-bc9b-72e18f88fc68');
        $favicon->setName('West-Friesland Favicon');
        $favicon->setDescription('West-Friesland VNG');
        $favicon->setBase64('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCBtZWV0IiB2aWV3Qm94PSIwIDAgNjQwIDY0MCIgd2lkdGg9IjY0MCIgaGVpZ2h0PSI2NDAiPjxkZWZzPjxwYXRoIGQ9Ik00MjAuMjQgODUuOEw0ODQuNTYgMTc0LjEzTDU1Ni4zNyAyNTYuNUw1MjcuNDEgMzYxLjg3TDUwNy43OSA0NjkuMzVMNDA3LjM0IDUxMi40MkwzMTEuMDggNTY0LjA4TDIxNC44IDUxMi40MkwxMTQuMzcgNDY5LjM1TDk0Ljc1IDM2MS44N0w2NS43OSAyNTYuNUwxMzcuNTggMTc0LjEzTDIwMS45MiA4NS44TDMxMS4wOCA5MC41OEwzMTEuMDggOTAuNThMNDIwLjI0IDg1LjhaIiBpZD0iZ2lWUXNjS1pNIj48L3BhdGg+PHBhdGggZD0iTTIxNi4zNCAyMjEuMzlDMjE2LjM0IDIyMS4zOSAyMDMuMjcgMjM5LjUyIDIwNi4xOCAyNDkuNTlDMjA2LjE4IDI0OS41OSAyMzMuMDEgMjgxLjQ5IDIzMy4wMSAyODEuNDlDMjMzLjAxIDI4MS40OSAyMzcuMzYgMjQ4Ljg3IDIzNi42NCAyMzkuNDRDMjM2LjY0IDIzOS40NCAyMzUuOTIgMjA4LjI1IDIzNS45MiAyMDguMjVDMjM1LjkyIDIwOC4yNSAyMzMuMDEgMTkxLjU2IDIzNS45MiAxOTAuMTJDMjM1LjkyIDE5MC4xMiAyNTEuMTMgMjAwLjk5IDI1MS4xMyAyMDAuOTlDMjUxLjEzIDIwMC45OSAyNjUuNjQgMTk2LjY0IDI3Mi4xOCAxOTguMUMyNzYuOTcgMTk5LjA4IDI4MS44MSAxOTkuODEgMjg2LjY4IDIwMC4yN0MyODguNDkgMTk5LjMzIDMwMi45OSAxOTEuNzggMzA0LjggMTkwLjg0QzMwNC44IDE5MC44NCAzMDEuOTEgMjEwLjQyIDI5OSAyMTMuMzNDMjk5IDIxMy4zMyAzMDMuMzQgMjM2LjUzIDMwMS45MSAyNDIuMzNDMzAwLjQ4IDI0OC4xMiAzMDguNDMgMjczLjUxIDMxNi40MiAyNzcuMTRDMzE2LjQyIDI3Ny4xNCAzMDMuMzQgMjkxLjY0IDMxNC4yMyAyOTAuOTJDMzI1LjEzIDI5MC4yIDM5MS43OSAyODAuMDUgNDI1LjE3IDMwMS4wN0M0MjUuMTcgMzAxLjA3IDQ0Ni4yMiAyNzIuODcgNDEzLjU5IDI3NS42OUMzODAuOTcgMjc4LjUxIDM4MC4yMyAyNjYuMjYgMzgwLjIzIDI2Ni4yNkMzODAuMjMgMjY2LjI2IDMyOC43MiAyNzMuNTEgMzI4LjcyIDIzNC4zNkMzMjguNzIgMTk1LjIxIDM2Ni40NCAyMDAuMjcgMzg2Ljc1IDIwMC4yN0M0MDcuMDUgMjAwLjI3IDQzMC4yNyAxODUuMDQgNDMwLjI3IDE4NS4wNEM0MzAuMjcgMTg1LjA0IDQ0NC43NiAxOTAuODQgNDM2Ljc5IDIwMy4xOEM0MjguODIgMjE1LjUyIDQxMC42OCAyMTkuODUgMzg2Ljc1IDIxOS44NUMzNjIuODEgMjE5Ljg1IDM0OC4zMiAyMjIuNzQgMzQ5LjA1IDIzMy42NEMzNDkuNzcgMjQ0LjUzIDM2OC42MyAyNDkuNSAzOTIuNTYgMjQ3LjQyQzQxNi41IDI0NS4zNCA0MzAuOTkgMjQ3LjQyIDQ0MS4xNCAyNTYuODNDNDUxLjMgMjY2LjI0IDQ3NC41MSAyOTkuNjMgNDM5LjcgMzE5LjE5QzQzOS43IDMxOS4xOSA0MzYuNzkgMzQ4LjIxIDQ0MC40MiAzNTQuMDFDNDQ0LjA1IDM1OS44MSA0NTkuMjggMzU5LjA4IDQ1OS4yOCAzNTkuMDhDNDU5LjI4IDM2NC4wOSA0NTkuMjggNDA0LjEyIDQ1OS4yOCA0MDkuMTNDNDU5LjI4IDQwOS4xMyA0NDkuODUgNDEwLjU3IDQ0OS4xMyA0MTYuMzlDNDQ5LjEzIDQxNi4zOSA0NDIuNTkgNDMyLjM0IDQzMi40NCA0MjYuNTRDNDMyLjQ0IDQyNi41NCA0MjMuMDEgNDI4LjczIDQxMi4xMyA0MjkuNDNDNDEyLjEzIDQyOS40MyAzOTYuOSA0MTIuNzYgNDAxLjI1IDQwNS41MUM0MDEuMjUgNDA1LjUxIDQyMC44NCA0MDAuNDIgNDI2LjY0IDQwMS4xNkM0MjYuNjQgNDAxLjE2IDQzOC45OCA0MDAuNDIgNDM4LjI0IDM5NS4zNkM0MzguMjQgMzk1LjM2IDQzNi43OSAzNzcuOTQgNDI5LjUzIDM3OC42N0M0MjkuNTMgMzc4LjY3IDQxMS40MSAzNzUuNzggNDA0Ljg1IDM2NC45QzQwNC44NSAzNjQuOSAzOTQuNyAzMzguOCAzOTQuNyAzMzguOEMzOTQuNyAzMzguOCAzNjcuODcgMzUxLjEzIDM3MC43NiAzNTkuODJDMzcwLjc2IDM1OS44MiAzNzcuMjggMzc5LjM5IDM3Ny4yOCAzNzkuMzlDMzc3LjI4IDM3OS4zOSAzNTQuODEgMzkyLjQ1IDM0OC4yOSA0MDEuMTZDMzQ4LjI5IDQwMS4xNiAzNDMuOTMgNDIwLjcyIDMzOC44NiA0MjEuNDZDMzM4Ljg2IDQyMS40NiAzMjEuNDQgNDEwLjU3IDMxNC4xOCA0MTIuNzZDMzE0LjE4IDQxMi43NiAzMDIuNTYgNDI1LjA5IDI5Ni43NiA0MjEuNDZDMjk2Ljc2IDQyMS40NiAyODYuNjMgNDA5Ljg3IDI3OS4zNyA0MDkuMTNDMjc5LjM3IDQwOS4xMyAyNzQuMjkgMzk1LjM2IDI4MyAzODguODRDMjgzIDM4OC44NCAzMDIuNTYgMzg5LjU0IDMwOS4xIDM5Mi4zNkMzMDkuMSAzOTIuMzYgMzI3Ljk2IDM4OC44NCAzMzIuMyAzODMuNjVDMzM0LjgyIDM4MC43NyAzMzcuMDEgMzc3LjYxIDMzOC44NCAzNzQuMjRDMzM4Ljg0IDM3NC4yNCAzMTcuODEgMzY0LjgxIDMxNS42MyAzNjYuOThDMzE1LjYzIDM2Ni45OCAzMzguODQgMzQ4LjEyIDMzOC44NCAzNDguMTJDMzM4Ljg0IDM0OC4xMiAzNTQuNzkgMzM0LjM1IDM1OC40MiAzMzAuNzJDMzU4LjQyIDMzMC43MiAzNTIuNjIgMzI2LjM3IDMzNS4yMSAzMzIuODlDMzE3Ljc5IDMzOS40MSAzMDEuMTIgMzU2LjgzIDI5NS4zMiAzNjAuNDZDMjg5LjUyIDM2NC4wOSAyODIuMjYgMzU1LjM4IDI4Mi4yNiAzNTUuMzhDMjc3LjU4IDM2Mi4yIDI3MS42OCAzNjguMTEgMjY0Ljg2IDM3Mi44QzI1My45OSAzODAuMDQgMjUwLjM3IDM4OC4wMyAyNDMuMTEgMzk4LjE2QzIzNS44NSA0MDguMyAyMjAuNjIgNDExLjk1IDIxNS41NCA0MDQuNjhDMjEwLjQ3IDM5Ny40MiAyMDMuOTQgNDAzLjI0IDE5OC4xNCA0MDcuNTlDMTkyLjM1IDQxMS45NSAxODIuMTkgNDA1LjQyIDE4Ny4yOSAzODkuNDVDMTkyLjM4IDM3My40OCAxOTkuNjMgMzc5LjMgMjEwLjQ4IDM3Ny44NkMyMjEuMzQgMzc2LjQxIDIzOC4wMyAzNzEuMzMgMjM4LjAzIDM0OC44NkMyMzguMDMgMzQ4Ljg2IDIyOS4zMyAzNDcuNCAyMTkuOTEgMzU0LjY0QzIxMC41IDM2MS44OSAxOTguMTQgMzQ0LjUxIDE5MC4xOCAzNDUuMjNDMTgyLjIxIDM0NS45NSAxNzguNjMgMzQyLjUgMTc4LjYzIDM0Mi41QzE3OC42MyAzNDIuNSAyMDkuODEgMzE0LjkzIDIwNC4wMSAzMTYuMzdDMjAwLjMzIDMxNy4xNyAxOTYuNDkgMzE2LjY2IDE5My4xNCAzMTQuOTNDMTk0LjE2IDMxMy45MSAyMDIuMjkgMzA1Ljc5IDIwMy4zMSAzMDQuNzhDMjAzLjMxIDMwNC43OCAxOTYuNzkgMjg4LjA4IDE5My44OCAyNzguNjdDMTkzLjg4IDI3OC42NyAxOTEuNjkgMjUzLjk5IDE4NS4xNyAyNTEuMUMxODUuMTcgMjUxLjEgMTc3LjkzIDI0My44NiAxODMuNzQgMjM2LjZDMTgzLjc0IDIzNi42IDE4NC40NSAyMTkuOTIgMTg1LjkxIDIxNC4xMkMxODcuMzcgMjA4LjMyIDIwMS4xMSAxOTUuMjYgMjA0Ljc0IDE5Ni43MUMyMDcuMDYgMjAxLjY0IDIxNi4zNCAyMDkuMDUgMjE2LjM0IDIyMS4zOVoiIGlkPSJpNWptT0gzNmkiPjwvcGF0aD48L2RlZnM+PGc+PGc+PGc+PHVzZSB4bGluazpocmVmPSIjZ2lWUXNjS1pNIiBvcGFjaXR5PSIxIiBmaWxsPSIjZmZjYjA0IiBmaWxsLW9wYWNpdHk9IjEiPjwvdXNlPjxnPjx1c2UgeGxpbms6aHJlZj0iI2dpVlFzY0taTSIgb3BhY2l0eT0iMSIgZmlsbC1vcGFjaXR5PSIwIiBzdHJva2U9IiMwMDAwMDAiIHN0cm9rZS13aWR0aD0iMSIgc3Ryb2tlLW9wYWNpdHk9IjAiPjwvdXNlPjwvZz48L2c+PGc+PHVzZSB4bGluazpocmVmPSIjaTVqbU9IMzZpIiBvcGFjaXR5PSIxIiBmaWxsPSIjMjYzMzcxIiBmaWxsLW9wYWNpdHk9IjEiPjwvdXNlPjxnPjx1c2UgeGxpbms6aHJlZj0iI2k1am1PSDM2aSIgb3BhY2l0eT0iMSIgZmlsbC1vcGFjaXR5PSIwIiBzdHJva2U9IiMwMDAwMDAiIHN0cm9rZS13aWR0aD0iMSIgc3Ryb2tlLW9wYWNpdHk9IjAiPjwvdXNlPjwvZz48L2c+PC9nPjwvZz48L3N2Zz4=');
        $favicon->setOrganization($westfriesland);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id' => $id]);

        // Westfriesland
        $style = new Style();
        $style->setName('Westfriesland Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #233A79;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($westfriesland);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        // Opmeer
        $id = Uuid::fromString('16fd1092-c4d3-4011-8998-0e15e13239cf');
        $opmeer = new Organization();
        $opmeer->setName('Opmeer');
        $opmeer->setDescription('Gemeente Opmeer');
        $opmeer->setRsin('999991413');
        $opmeer->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '26dee7a2-0fb6-4cc8-b5f6-0b5e2f8aa789']));
        $manager->persist($opmeer);
        $opmeer->setId($id);
        $manager->persist($opmeer);
        $manager->flush();
        $opmeer = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Opmeer
        $style = new Style();
        $style->setName('Opmeer Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #0F2F52;--primary2: white;--secondary: #4D9A08;--secondary2: #4D9A08;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($opmeer);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('434d3b10-13ec-4ad8-a62a-c9c4185d717d');
        $bgAartswoud = new Organization();
        $bgAartswoud->setName('Aartswoud');
        $bgAartswoud->setDescription('Begraafplaats Aartswoud');
        $bgAartswoud->setParentOrganization($opmeer);
        $bgAartswoud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgAartswoud->setRsin('1234');
        $manager->persist($bgAartswoud);
        $bgAartswoud->setId($id);
        $manager->persist($bgAartswoud);
        $manager->flush();
        $bgAartswoud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f53aa9a3-c1d6-42d2-9162-c09e859fee41');
        $bgOpmeer = new Organization();
        $bgOpmeer->setName('Opmeer');
        $bgOpmeer->setDescription('Begraafplaats Opmeer');
        $bgOpmeer->setParentOrganization($opmeer);
        $bgOpmeer->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgOpmeer->setRsin('1234');
        $manager->persist($bgOpmeer);
        $bgOpmeer->setId($id);
        $manager->persist($bgOpmeer);
        $manager->flush();
        $bgOpmeer = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('470af19c-7398-4060-899b-4c3502609555');
        $bgSpanbroek = new Organization();
        $bgSpanbroek->setName('Spanbroek');
        $bgSpanbroek->setDescription('Begraafplaats Spanbroek');
        $bgSpanbroek->setParentOrganization($opmeer);
        $bgSpanbroek->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgSpanbroek->setRsin('1234');
        $manager->persist($bgSpanbroek);
        $bgSpanbroek->setId($id);
        $manager->persist($bgSpanbroek);
        $manager->flush();
        $bgSpanbroek = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('0b6a30d3-561f-426c-aab7-9ae47f5da832');
        $bgHoogwoud = new Organization();
        $bgHoogwoud->setName('Hoogwoud');
        $bgHoogwoud->setDescription('Begraafplaats Hoogwoud');
        $bgHoogwoud->setParentOrganization($opmeer);
        $bgHoogwoud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgHoogwoud->setRsin('1234');
        $manager->persist($bgHoogwoud);
        $bgHoogwoud->setId($id);
        $manager->persist($bgHoogwoud);
        $manager->flush();
        $bgHoogwoud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('573bec0c-996b-4ddd-b522-8dcb26573e69');
        $bgDeWeere = new Organization();
        $bgDeWeere->setName('De Weere');
        $bgDeWeere->setDescription('Begraafplaats De Weere');
        $bgDeWeere->setParentOrganization($opmeer);
        $bgDeWeere->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgDeWeere->setRsin('1234');
        $manager->persist($bgDeWeere);
        $bgDeWeere->setId($id);
        $manager->persist($bgDeWeere);
        $manager->flush();
        $bgDeWeere = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Medemblik
        $id = Uuid::fromString('429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $medemblik = new Organization();
        $medemblik->setName('Medemblik');
        $medemblik->setDescription('Gemeente Medemblik');
        $medemblik->setRsin('999993562');
        $medemblik->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '47c8c694-62bb-4dec-b054-556537e896fe']));
        $manager->persist($medemblik);
        $medemblik->setId($id);
        $manager->persist($medemblik);
        $manager->flush();
        $medemblik = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Medemblik
        $style = new Style();
        $style->setName('Medemblik Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #003E51;--primary2: white;--secondary: #509E2F;--secondary2: #509E2F;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($medemblik);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('fa93bb61-4a3b-4f5f-a8a9-c53c3e922a3b');
        $bgOpperdoes = new Organization();
        $bgOpperdoes->setName('Opperdoes');
        $bgOpperdoes->setDescription('Begraafplaats Opperdoes');
        $bgOpperdoes->setParentOrganization($medemblik);
        $bgOpperdoes->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgOpperdoes->setRsin('1234');
        $manager->persist($bgOpperdoes);
        $bgOpperdoes->setId($id);
        $manager->persist($bgOpperdoes);
        $manager->flush();
        $bgOpperdoes = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('07a13576-8455-4cf5-9543-5c55b894a817');
        $bgSijbekarspel = new Organization();
        $bgSijbekarspel->setName('Sijbekarspel (oud)');
        $bgSijbekarspel->setDescription('Begraafplaats Sijbekarspel (oud)');
        $bgSijbekarspel->setParentOrganization($medemblik);
        $bgSijbekarspel->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgSijbekarspel->setRsin('1234');
        $manager->persist($bgSijbekarspel);
        $bgSijbekarspel->setId($id);
        $manager->persist($bgSijbekarspel);
        $manager->flush();
        $bgSijbekarspel = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('97d5aa85-1729-4099-bc63-e26f4660f8ef');
        $bgBenningbroekOud = new Organization();
        $bgBenningbroekOud->setName('Benningbroek (Oud)');
        $bgBenningbroekOud->setDescription('Begraafplaats Benningbroek (Oud)');
        $bgBenningbroekOud->setParentOrganization($medemblik);
        $bgBenningbroekOud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgBenningbroekOud->setRsin('1234');
        $manager->persist($bgBenningbroekOud);
        $bgBenningbroekOud->setId($id);
        $manager->persist($bgBenningbroekOud);
        $manager->flush();
        $bgBenningbroekOud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('bd40d684-dccd-43a5-b1e9-cc365d6445f8');
        $bgBenningbroekNieuw = new Organization();
        $bgBenningbroekNieuw->setName('Benningbroek (Nieuw)');
        $bgBenningbroekNieuw->setDescription('Begraafplaats Benningbroek (Nieuw)');
        $bgBenningbroekNieuw->setParentOrganization($medemblik);
        $bgBenningbroekNieuw->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgBenningbroekNieuw->setRsin('1234');
        $manager->persist($bgBenningbroekNieuw);
        $bgBenningbroekNieuw->setId($id);
        $manager->persist($bgBenningbroekNieuw);
        $manager->flush();
        $bgBenningbroekNieuw = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('b11e25d3-a3a5-46f4-9323-462bd170ad3a');
        $bgAndijkOosterbegraafplaats = new Organization();
        $bgAndijkOosterbegraafplaats->setName('Andijk (oosterbegraafplaats)');
        $bgAndijkOosterbegraafplaats->setDescription('Begraafplaats Andijk (oosterbegraafplaats)');
        $bgAndijkOosterbegraafplaats->setParentOrganization($medemblik);
        $bgAndijkOosterbegraafplaats->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgAndijkOosterbegraafplaats->setRsin('1234');
        $manager->persist($bgAndijkOosterbegraafplaats);
        $bgAndijkOosterbegraafplaats->setId($id);
        $manager->persist($bgAndijkOosterbegraafplaats);
        $manager->flush();
        $bgAndijkOosterbegraafplaats = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d05edd61-8f43-41f7-b3bb-b10959135033');
        $bgWognumKreekland = new Organization();
        $bgWognumKreekland->setName('Wognum (kreekland)');
        $bgWognumKreekland->setDescription('Begraafplaats Wognum (kreekland)');
        $bgWognumKreekland->setParentOrganization($medemblik);
        $bgWognumKreekland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgWognumKreekland->setRsin('1234');
        $manager->persist($bgWognumKreekland);
        $bgWognumKreekland->setId($id);
        $manager->persist($bgWognumKreekland);
        $manager->flush();
        $bgWognumKreekland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('d3f51790-9ffd-4c10-b8ad-c0c5d2bb8b29');
        $bgOostwoud = new Organization();
        $bgOostwoud->setName('Oostwoud');
        $bgOostwoud->setDescription('Begraafplaats Oostwoud (nieuw)');
        $bgOostwoud->setParentOrganization($medemblik);
        $bgOostwoud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgOostwoud->setRsin('1234');
        $manager->persist($bgOostwoud);
        $bgOostwoud->setId($id);
        $manager->persist($bgOostwoud);
        $manager->flush();
        $bgOostwoud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('9246649e-2bb4-4f59-b6b1-37df88f37086');
        $bgMidwoud = new Organization();
        $bgMidwoud->setName('Midwoud');
        $bgMidwoud->setDescription('Begraafplaats Midwoud (nieuw)');
        $bgMidwoud->setParentOrganization($medemblik);
        $bgMidwoud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgMidwoud->setRsin('1234');
        $manager->persist($bgMidwoud);
        $bgMidwoud->setId($id);
        $manager->persist($bgMidwoud);
        $manager->flush();
        $bgMidwoud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('6d5798e1-e14b-4b9d-81f4-282e44f06903');
        $bgLambertschaag = new Organization();
        $bgLambertschaag->setName('Lambertschaag');
        $bgLambertschaag->setDescription('Begraafplaats Lambertschaag');
        $bgLambertschaag->setParentOrganization($medemblik);
        $bgLambertschaag->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgLambertschaag->setRsin('1234');
        $manager->persist($bgLambertschaag);
        $bgLambertschaag->setId($id);
        $manager->persist($bgLambertschaag);
        $manager->flush();
        $bgLambertschaag = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('16758322-693b-4406-ae42-8f6877daa8c4');
        $bgAbbekerk = new Organization();
        $bgAbbekerk->setName('Abbekerk');
        $bgAbbekerk->setDescription('Begraafplaats Abbekerk (nieuw)');
        $bgAbbekerk->setParentOrganization($medemblik);
        $bgAbbekerk->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgAbbekerk->setRsin('1234');
        $manager->persist($bgAbbekerk);
        $bgAbbekerk->setId($id);
        $manager->persist($bgAbbekerk);
        $manager->flush();
        $bgAbbekerk = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('bcdb1f69-7187-4ebe-b42a-afd2dfd8e959');
        $bgOpperdoesOud = new Organization();
        $bgOpperdoesOud->setName('Opperdoes (oud)');
        $bgOpperdoesOud->setDescription('Begraafplaats Opperdoes (oud)');
        $bgOpperdoesOud->setParentOrganization($medemblik);
        $bgOpperdoesOud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgOpperdoesOud->setRsin('1234');
        $manager->persist($bgOpperdoesOud);
        $bgOpperdoesOud->setId($id);
        $manager->persist($bgOpperdoesOud);
        $manager->flush();
        $bgOpperdoesOud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('32846a42-556c-4d58-aaba-7cbfcd7b4c0f');
        $bgWognum = new Organization();
        $bgWognum->setName('Wognum');
        $bgWognum->setDescription('Begraafplaats Wognum');
        $bgWognum->setParentOrganization($medemblik);
        $bgWognum->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgWognum->setRsin('1234');
        $manager->persist($bgWognum);
        $bgWognum->setId($id);
        $manager->persist($bgWognum);
        $manager->flush();
        $bgWognum = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('a122c7cf-7398-4a06-9d01-230641ad3e14');
        $bgNibbixwoud = new Organization();
        $bgNibbixwoud->setName('Nibbixwoud');
        $bgNibbixwoud->setDescription('Begraafplaats Nibbixwoud');
        $bgNibbixwoud->setParentOrganization($medemblik);
        $bgNibbixwoud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgNibbixwoud->setRsin('1234');
        $manager->persist($bgNibbixwoud);
        $bgNibbixwoud->setId($id);
        $manager->persist($bgNibbixwoud);
        $manager->flush();
        $bgNibbixwoud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('60afc15c-b45f-4d42-bc3d-546575e1eb36');
        $bgMidwoudOud = new Organization();
        $bgMidwoudOud->setName('Midwoud (oud)');
        $bgMidwoudOud->setDescription('Begraafplaats Midwoud (oud)');
        $bgMidwoudOud->setParentOrganization($medemblik);
        $bgMidwoudOud->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgMidwoudOud->setRsin('1234');
        $manager->persist($bgMidwoudOud);
        $bgMidwoudOud->setId($id);
        $manager->persist($bgMidwoudOud);
        $manager->flush();
        $bgMidwoudOud = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('ddb4d97d-370a-4972-bbb2-82f6dd92fab8');
        $bgAndijkWesterbegraafplaats = new Organization();
        $bgAndijkWesterbegraafplaats->setName('Andijk (Westerbegraafplaats)');
        $bgAndijkWesterbegraafplaats->setDescription('Begraafplaats Andijk (Westerbegraafplaats)');
        $bgAndijkWesterbegraafplaats->setParentOrganization($medemblik);
        $bgAndijkWesterbegraafplaats->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgAndijkWesterbegraafplaats->setRsin('1234');
        $manager->persist($bgAndijkWesterbegraafplaats);
        $bgAndijkWesterbegraafplaats->setId($id);
        $manager->persist($bgAndijkWesterbegraafplaats);
        $manager->flush();
        $bgAndijkWesterbegraafplaats = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7914b4c4-e227-4fbd-8ed6-7e87ced0115b');
        $bgTwisk = new Organization();
        $bgTwisk->setName('Twisk');
        $bgTwisk->setDescription('Begraafplaats Twisk (nieuw)');
        $bgTwisk->setParentOrganization($medemblik);
        $bgTwisk->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgTwisk->setRsin('1234');
        $manager->persist($bgTwisk);
        $bgTwisk->setId($id);
        $manager->persist($bgTwisk);
        $manager->flush();
        $bgTwisk = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('a5911a24-30d2-4a2d-afd3-a4d4e1d0e814');
        $bgMedemblikZorgvliet = new Organization();
        $bgMedemblikZorgvliet->setName('Medemblik (zorgvliet)');
        $bgMedemblikZorgvliet->setDescription('Begraafplaats Wognum (Zorgvliet)');
        $bgMedemblikZorgvliet->setParentOrganization($medemblik);
        $bgMedemblikZorgvliet->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgMedemblikZorgvliet->setRsin('1234');
        $manager->persist($bgMedemblikZorgvliet);
        $bgMedemblikZorgvliet->setId($id);
        $manager->persist($bgMedemblikZorgvliet);
        $manager->flush();
        $bgMedemblikZorgvliet = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Enkhuizen
        $id = Uuid::fromString('7033eeb4-5c77-4d88-9f40-303b538f176f');
        $enkhuizen = new Organization();
        $enkhuizen->setName('Enkhuizen');
        $enkhuizen->setDescription('Gemeente Enkhuizen');
        $enkhuizen->setRsin('999993859');
        $enkhuizen->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '0012428b-dc06-444a-af20-17d3ee06a916']));
        $manager->persist($enkhuizen);
        $enkhuizen->setId($id);
        $manager->persist($enkhuizen);
        $manager->flush();
        $enkhuizen = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Enkhuizen
        $style = new Style();
        $style->setName('Enkhuizen Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #003E51;--primary2: white;--secondary: #509E2F;--secondary2: #509E2F;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($enkhuizen);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('d90be6c6-7b1e-4b75-879b-6445cc56aecb');
        $bgGemeentelijkeBegraafplaats = new Organization();
        $bgGemeentelijkeBegraafplaats->setName('Gemeentelijke Begraafplaats');
        $bgGemeentelijkeBegraafplaats->setDescription('Gemeentelijke Begraafplaats');
        $bgGemeentelijkeBegraafplaats->setParentOrganization($enkhuizen);
        $bgGemeentelijkeBegraafplaats->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgGemeentelijkeBegraafplaats->setRsin('1234');
        $manager->persist($bgGemeentelijkeBegraafplaats);
        $bgGemeentelijkeBegraafplaats->setId($id);
        $manager->persist($bgGemeentelijkeBegraafplaats);
        $manager->flush();
        $bgGemeentelijkeBegraafplaats = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Drechterland
        $id = Uuid::fromString('e7d5368d-4d95-454d-9c0e-d4466889e2bd');
        $drechterland = new Organization();
        $drechterland->setName('Drechterland');
        $drechterland->setDescription('Gemeenten Drechterland');
        $drechterland->setRsin('999992181');
        $drechterland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '756e50b8-4fd7-44d4-99d6-7f8ef47c3678']));
        $manager->persist($drechterland);
        $drechterland->setId($id);
        $manager->persist($drechterland);
        $manager->flush();
        $drechterland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Drechterland
        $style = new Style();
        $style->setName('Drechterland Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #003E51;--primary2: white;--secondary: #509E2F;--secondary2: #509E2F;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($drechterland);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('bcf1f7b9-84b6-46d1-a998-16fa042e1326');
        $bgStreekwegHoogkarspel = new Organization();
        $bgStreekwegHoogkarspel->setName('Streekweg in Hoogkarspel');
        $bgStreekwegHoogkarspel->setDescription('Begraafplaats Streekweg in Hoogkarspel');
        $bgStreekwegHoogkarspel->setParentOrganization($drechterland);
        $bgStreekwegHoogkarspel->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgStreekwegHoogkarspel->setRsin('1234');
        $manager->persist($bgStreekwegHoogkarspel);
        $bgStreekwegHoogkarspel->setId($id);
        $manager->persist($bgStreekwegHoogkarspel);
        $manager->flush();
        $bgStreekwegHoogkarspel = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('18b08193-797e-4583-b431-7870364d2949');
        $bgKerkbuurtWijdenes = new Organization();
        $bgKerkbuurtWijdenes->setName('Kerkbuurt in Wijdenes');
        $bgKerkbuurtWijdenes->setDescription('Begraafplaats Kerkbuurt in Wijdenes');
        $bgKerkbuurtWijdenes->setParentOrganization($drechterland);
        $bgKerkbuurtWijdenes->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgKerkbuurtWijdenes->setRsin('1234');
        $manager->persist($bgKerkbuurtWijdenes);
        $bgKerkbuurtWijdenes->setId($id);
        $manager->persist($bgKerkbuurtWijdenes);
        $manager->flush();
        $bgKerkbuurtWijdenes = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('4d6e1e59-2190-4b45-bb1e-025cd5ab0a0d');
        $bgWesterkerkwegVenhuizen = new Organization();
        $bgWesterkerkwegVenhuizen->setName('Westerkerkweg in Venhuizen');
        $bgWesterkerkwegVenhuizen->setDescription('Begraafplaats Westerkerkweg in Venhuizen');
        $bgWesterkerkwegVenhuizen->setParentOrganization($drechterland);
        $bgWesterkerkwegVenhuizen->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgWesterkerkwegVenhuizen->setRsin('1234');
        $manager->persist($bgWesterkerkwegVenhuizen);
        $bgWesterkerkwegVenhuizen->setId($id);
        $manager->persist($bgWesterkerkwegVenhuizen);
        $manager->flush();
        $bgWesterkerkwegVenhuizen = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('fde402af-09bc-4163-b3a8-1bddf9a51e26');
        $bgRaadhuispleinHoogkarspel = new Organization();
        $bgRaadhuispleinHoogkarspel->setName('Raadhuisplein in Hoogkarspel');
        $bgRaadhuispleinHoogkarspel->setDescription('Begraafplaats Raadhuisplein in Hoogkarspel');
        $bgRaadhuispleinHoogkarspel->setParentOrganization($drechterland);
        $bgRaadhuispleinHoogkarspel->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgRaadhuispleinHoogkarspel->setRsin('1234');
        $manager->persist($bgRaadhuispleinHoogkarspel);
        $bgRaadhuispleinHoogkarspel->setId($id);
        $manager->persist($bgRaadhuispleinHoogkarspel);
        $manager->flush();
        $bgRaadhuispleinHoogkarspel = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('02ccf2d0-0ba0-4a62-b0fd-5e11cf102814');
        $bgMolenweiHoogkarspel = new Organization();
        $bgMolenweiHoogkarspel->setName('Molenwei in Hoogkarspel');
        $bgMolenweiHoogkarspel->setDescription('Begraafplaats Molenwei in Hoogkarspel');
        $bgMolenweiHoogkarspel->setParentOrganization($drechterland);
        $bgMolenweiHoogkarspel->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgMolenweiHoogkarspel->setRsin('1234');
        $manager->persist($bgMolenweiHoogkarspel);
        $bgMolenweiHoogkarspel->setId($id);
        $manager->persist($bgMolenweiHoogkarspel);
        $manager->flush();
        $bgMolenweiHoogkarspel = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('e2653b9a-15f9-4a17-8f95-3a8379a699df');
        $bgDorpswegSchellinkhout = new Organization();
        $bgDorpswegSchellinkhout->setName('Dorpsweg in Schellinkhout');
        $bgDorpswegSchellinkhout->setDescription('Begraafplaats Dorpsweg in Schellinkhout');
        $bgDorpswegSchellinkhout->setParentOrganization($drechterland);
        $bgDorpswegSchellinkhout->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgDorpswegSchellinkhout->setRsin('1234');
        $manager->persist($bgDorpswegSchellinkhout);
        $bgDorpswegSchellinkhout->setId($id);
        $manager->persist($bgDorpswegSchellinkhout);
        $manager->flush();
        $bgDorpswegSchellinkhout = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('132151ef-afd0-4e82-a71d-a77aed4cb88f');
        $bgOosterleek = new Organization();
        $bgOosterleek->setName('Oosterleek');
        $bgOosterleek->setDescription('Begraafplaats in Oosterleek');
        $bgOosterleek->setParentOrganization($drechterland);
        $bgOosterleek->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgOosterleek->setRsin('1234');
        $manager->persist($bgOosterleek);
        $bgOosterleek->setId($id);
        $manager->persist($bgOosterleek);
        $manager->flush();
        $bgOosterleek = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2bb53f5f-657b-4387-ac1f-3a599e3f3b67');
        $bgSchoollaanHem = new Organization();
        $bgSchoollaanHem->setName('Schoollaan in Hem');
        $bgSchoollaanHem->setDescription('Begraafplaats Schoollaan in Hem');
        $bgSchoollaanHem->setParentOrganization($drechterland);
        $bgSchoollaanHem->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgSchoollaanHem->setRsin('1234');
        $manager->persist($bgSchoollaanHem);
        $bgSchoollaanHem->setId($id);
        $manager->persist($bgSchoollaanHem);
        $manager->flush();
        $bgSchoollaanHem = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // stedebroec
        $id = Uuid::fromString('a5567d87-ca05-45e9-a888-184494a3c79c');
        $stedebroec = new Organization();
        $stedebroec->setName('Stedebroec');
        $stedebroec->setDescription('Gemeenten Stedebroec');
        $stedebroec->setRsin('999991450');
        $stedebroec->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '93a892a9-d164-4d37-bfa5-a37c52ab3840']));
        $manager->persist($stedebroec);
        $stedebroec->setId($id);
        $manager->persist($stedebroec);
        $manager->flush();
        $stedebroec = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // stedebroec
        $style = new Style();
        $style->setName('Stedebroec Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #003E51;--primary2: white;--secondary: #509E2F;--secondary2: #509E2F;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($stedebroec);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('79dfbe93-e26d-426e-80ec-eb33310359ee');
        $bgRustoord = new Organization();
        $bgRustoord->setName('Rustoord');
        $bgRustoord->setDescription('Algemene Begraafplaats "Rustoord"');
        $bgRustoord->setParentOrganization($stedebroec);
        $bgRustoord->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgRustoord->setRsin('1234');
        $manager->persist($bgRustoord);
        $bgRustoord->setId($id);
        $manager->persist($bgRustoord);
        $manager->flush();
        $bgRustoord = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Hoorn
        $id = Uuid::fromString('d736013f-ad6d-4885-b816-ce72ac3e1384');
        $hoorn = new Organization();
        $hoorn->setName('Hoorn');
        $hoorn->setDescription('Gemeente Hoorn');
        $hoorn->setRsin('999995121');
        $hoorn->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '816395fc-4ba4-4fa5-90e9-780bb14a50c2']));
        $manager->persist($hoorn);
        $hoorn->setId($id);
        $manager->persist($hoorn);
        $manager->flush();
        $hoorn = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Hoorn
        $style = new Style();
        $style->setName('Hoorn Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #266EA1;--primary2: white;--secondary: #F5AB63;--secondary2: #F5AB63;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($hoorn);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('d503eddf-0641-489d-a390-560b767d501b');
        $bgZwaag = new Organization();
        $bgZwaag->setName('Zwaag');
        $bgZwaag->setDescription('Begraafplaats Zwaag');
        $bgZwaag->setParentOrganization($hoorn);
        $bgZwaag->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgZwaag->setRsin('1234');
        $manager->persist($bgZwaag);
        $bgZwaag->setId($id);
        $manager->persist($bgZwaag);
        $manager->flush();
        $bgZwaag = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('71dd5b37-1001-45ff-be29-a0a3d0dfa130');
        $bgBerkhouterweg = new Organization();
        $bgBerkhouterweg->setName('Berkhouterweg');
        $bgBerkhouterweg->setDescription('Begraafplaats Berkhouterweg');
        $bgBerkhouterweg->setParentOrganization($hoorn);
        $bgBerkhouterweg->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgBerkhouterweg->setRsin('1234');
        $manager->persist($bgBerkhouterweg);
        $bgBerkhouterweg->setId($id);
        $manager->persist($bgBerkhouterweg);
        $manager->flush();
        $bgBerkhouterweg = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('b1e723e5-39b6-4680-92ba-1a5082767acc');
        $bgKeern = new Organization();
        $bgKeern->setName('Keern');
        $bgKeern->setDescription('Begraafplaats Keern');
        $bgKeern->setParentOrganization($hoorn);
        $bgKeern->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgKeern->setRsin('1234');
        $manager->persist($bgKeern);
        $bgKeern->setId($id);
        $manager->persist($bgKeern);
        $manager->flush();
        $bgKeern = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7aad8969-2085-43cf-b27c-a83c036b137f');
        $bgZuiderveld = new Organization();
        $bgZuiderveld->setName('Zuiderveld');
        $bgZuiderveld->setDescription('Begraafplaats Zuiderveld');
        $bgZuiderveld->setParentOrganization($hoorn);
        $bgZuiderveld->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgZuiderveld->setRsin('1234');
        $manager->persist($bgZuiderveld);
        $bgZuiderveld->setId($id);
        $manager->persist($bgZuiderveld);
        $manager->flush();
        $bgZuiderveld = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Koggenland
        $id = Uuid::fromString('f050292c-973d-46ab-97ae-9d8830a59d15');
        $koggenland = new Organization();
        $koggenland->setName('Koggenland');
        $koggenland->setDescription('Gemeente Koggenland');
        $koggenland->setRsin('999994141');
        $koggenland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '5792b63d-afb5-4689-990b-51eec52b663b']));
        $manager->persist($koggenland);
        $koggenland->setId($id);
        $manager->persist($koggenland);
        $manager->flush();
        $koggenland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Koggenland
        $style = new Style();
        $style->setName('Koggenland Style');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #22007A;--primary2: white;--secondary: #289728;--secondary2: #289728;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($koggenland);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('f2f309ac-f9d2-44ed-a522-42db5b437a01');
        $bgObdam = new Organization();
        $bgObdam->setName('Obdam');
        $bgObdam->setDescription('Begraafplaats Obdam');
        $bgObdam->setParentOrganization($koggenland);
        $bgObdam->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgObdam->setRsin('1234');
        $manager->persist($bgObdam);
        $bgObdam->setId($id);
        $manager->persist($bgObdam);
        $manager->flush();
        $bgObdam = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('2341e79f-5ef0-4a41-8e4c-d602ca5c8597');
        $bgUrsem = new Organization();
        $bgUrsem->setName('Ursem');
        $bgUrsem->setDescription('Begraafplaats Ursem');
        $bgUrsem->setParentOrganization($koggenland);
        $bgUrsem->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgUrsem->setRsin('1234');
        $manager->persist($bgUrsem);
        $bgUrsem->setId($id);
        $manager->persist($bgUrsem);
        $manager->flush();
        $bgUrsem = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('f3f7b361-1556-4680-9217-c8c1ffdb6a48');
        $bgAvenhorn = new Organization();
        $bgAvenhorn->setName('Avenhorn');
        $bgAvenhorn->setDescription('Begraafplaats Avenhorn');
        $bgAvenhorn->setParentOrganization($koggenland);
        $bgAvenhorn->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgAvenhorn->setRsin('1234');
        $manager->persist($bgAvenhorn);
        $bgAvenhorn->setId($id);
        $manager->persist($bgAvenhorn);
        $manager->flush();
        $bgAvenhorn = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('058ac88e-48a4-4240-93bf-9a94d877f83d');
        $bgOudendijk = new Organization();
        $bgOudendijk->setName('Oudendijk');
        $bgOudendijk->setDescription('Begraafplaats Oudendijk');
        $bgOudendijk->setParentOrganization($koggenland);
        $bgOudendijk->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgOudendijk->setRsin('1234');
        $manager->persist($bgOudendijk);
        $bgOudendijk->setId($id);
        $manager->persist($bgOudendijk);
        $manager->flush();
        $bgOudendijk = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('6904d10e-eb6d-4c1e-83b2-3d5aacf46b86');
        $bgBerkhout = new Organization();
        $bgBerkhout->setName('Berkhout');
        $bgBerkhout->setDescription('Begraafplaats Berkhout');
        $bgBerkhout->setParentOrganization($koggenland);
        $bgBerkhout->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgBerkhout->setRsin('1234');
        $manager->persist($bgBerkhout);
        $bgBerkhout->setId($id);
        $manager->persist($bgBerkhout);
        $manager->flush();
        $bgBerkhout = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('7b8a014a-ee43-4bf2-a21d-12d0ee3c1e8c');
        $bgGrosthuizen = new Organization();
        $bgGrosthuizen->setName('Grosthuizen');
        $bgGrosthuizen->setDescription('Begraafplaats Grosthuizen');
        $bgGrosthuizen->setParentOrganization($koggenland);
        $bgGrosthuizen->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgGrosthuizen->setRsin('1234');
        $manager->persist($bgGrosthuizen);
        $bgGrosthuizen->setId($id);
        $manager->persist($bgGrosthuizen);
        $manager->flush();
        $bgGrosthuizen = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        $id = Uuid::fromString('3233126a-a9c1-4772-9f86-73a2f79c7675');
        $bgHensbroek = new Organization();
        $bgHensbroek->setName('Hensbroek');
        $bgHensbroek->setDescription('Begraafplaats Hensbroek');
        $bgHensbroek->setParentOrganization($koggenland);
        $bgHensbroek->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $bgHensbroek->setRsin('1234');
        $manager->persist($bgHensbroek);
        $bgHensbroek->setId($id);
        $manager->persist($bgHensbroek);
        $manager->flush();
        $bgHensbroek = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Hogeland
        /*
        $id = Uuid::fromString('79ad319b-1ff6-4e21-919b-4ea002b5f233');
        $hogeland = new Organization();
        $hogeland->setName('Hogeland');
        $hogeland->setDescription('Gemeente Hogeland');
        $hogeland->setRsin('1234');
//      $hogeland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '5792b63d-afb5-4689-990b-51eec52b663b']));
        $manager->persist($hogeland);
        $hogeland->setId($id);
        $manager->persist($hogeland);
        $manager->flush();
        $hogeland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Hogeland
        $style = new Style();
        $style->setName('Hogeland Style');
        $style->setDescription('Huistlijl Westfriese gemeente Hogeland');
        $style->setCss(':root {background: white;--primary: #1BB7BA;--primary-color: white;--secondary: #FFCC00;--secondary-color: black;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($hogeland);

        $manager->persist($favicon);
        $manager->persist($style);
        $manager->flush();
        */

        $id = Uuid::fromString('2c60657d-a728-4e71-897d-ac407c134e10');
        $headerimg = new Image();
        $headerimg->setName('header image');
        $headerimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/afbeeldingen/westfrieslandheader.jfif', 'r')));
        $headerimg->setDescription('Zuid-Drecht header');
        $headerimg->setOrganization($westfriesland);
        $manager->persist($headerimg);
        $headerimg->setId($id);
        $manager->persist($headerimg);
        $manager->flush();
        $headerimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('West-Friesland Logo');
        $logo->setDescription('West-Friesland VNG');
        $logo->setOrganization($westfriesland);

        $stylePan = new Style();
        $stylePan->setName('West-Friesland');
        $stylePan->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $stylePan->setCss('

            :root {
            --primary: #233A79;
            --primary-color: white;
            --secondary: #FFCB04;
            --secondary-color: #263371;

            --header: white;
            --menu: #233A79;
            --menu-over: #FFCB04;
            --menu-color: white;
            --footer: #233A79;
            --footer-color: white;
            }

            .header-logo a:before {
            margin-left: -30px;
            background: url("data:image/svg+xml;base64,PHN2ZyBpZD0iTGFhZ18xIiBkYXRhLW5hbWU9IkxhYWcgMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMzYzLjA5IDMyMC4zNSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiMyNjMzNzE7fS5jbHMtMntmaWxsOiNmZmNiMDQ7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT5sb2dvIFdlc3Rmcmllc2xhbmQgdmVjdG9yPC90aXRsZT48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0yNjUuNSw0NTIuNDNsNy0xOC40YTUuNDgsNS40OCwwLDAsMSwyLjI2LDEuMzMsNSw1LDAsMCwxLC43Mi45Myw0LjU4LDQuNTgsMCwwLDEsLjQ5LDEuMjMsNiw2LDAsMCwxLC4xNCwxLjU4LDcuNzEsNy43MSwwLDAsMS0uMzMsMmMtLjM4LDEtLjc4LDIuMTEtMS4yLDMuMjNsLTEuMjMsMy4zYy0uNCwxLjA4LS43OSwyLjExLTEuMTYsMy4xbC0xLDIuNjVjLS4zLjc4LS41NCwxLjQzLS43MywxLjk0bC0uMzcsMWMtLjQxLDEuMTEtLjgxLDIuMDgtMS4xOSwyLjlzLS43NCwxLjU0LTEuMDcsMi4xM2ExNi4xMywxNi4xMywwLDAsMS0uOTUsMS41LDgsOCwwLDAsMS0uODEsMSwyLjM0LDIuMzQsMCwwLDEtMS41Ni44NmwtNi4wNi0xNS40Ny02LjA3LDE1LjQ3YTIuMzQsMi4zNCwwLDAsMS0xLjU1LS44Niw3LjIsNy4yLDAsMCwxLS44MS0xLDE0LjI3LDE0LjI3LDAsMCwxLS45NS0xLjVjLS4zNC0uNTktLjY5LTEuMy0xLjA3LTIuMTNzLS43Ni0xLjc5LTEuMTctMi45bC0uMzctMWMtLjE5LS41MS0uNDMtMS4xNi0uNzMtMS45NHMtLjYzLTEuNjYtMS0yLjY1bC0xLjE3LTMuMXEtLjYyLTEuNjItMS4yMy0zLjNsLTEuMjEtMy4yM2E3LjcxLDcuNzEsMCwwLDEtLjMzLTIsNS41OSw1LjU5LDAsMCwxLC4xNS0xLjU4LDQuMjcsNC4yNywwLDAsMSwuNDktMS4yMyw1LjQxLDUuNDEsMCwwLDEsLjcxLS45Myw1LjU4LDUuNTgsMCwwLDEsMi4yNy0xLjMzbDcsMTguNCw3LTE2LjczWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTMwNC41NSw0NjQuMDZIMjgyVjQzNC40N2gyMi41MWE2LDYsMCwwLDEtLjI1LDEuODUsNC40Niw0LjQ2LDAsMCwxLS42NSwxLjM1LDQuMzcsNC4zNywwLDAsMS0uOTMuOTQsNS45LDUuOSwwLDAsMS0xLjA3LjU4LDcsNywwLDAsMS0yLjg4LjQ1SDI4Ny40OHY2LjY1aDExLjlhNi40OCw2LjQ4LDAsMCwxLS4yMSwxLjc0LDQuOTQsNC45NCwwLDAsMS0uNTgsMS4zMSw0LDQsMCwwLDEtLjguOTIsNS41LDUuNSwwLDAsMS0uOTIuNjIsNiw2LDAsMCwxLTIuNTEuNmgtNi44OHY3LjQxaDEyYTYuMyw2LjMsMCwwLDEsMS43Mi4yMiw0LjYsNC42LDAsMCwxLDEuMjguNTksMy44NCwzLjg0LDAsMCwxLC45MS44Myw1LjExLDUuMTEsMCwwLDEsLjU5LDFBNi40Myw2LjQzLDAsMCwxLDMwNC41NSw0NjQuMDZaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzE3LjQ2LDQzOS43MWEzLjU2LDMuNTYsMCwwLDAtMS4xNy4xMSwzLjc5LDMuNzksMCwwLDAtLjUuMTgsMi42NSwyLjY1LDAsMCwwLS41Mi4yOCwyLjcyLDIuNzIsMCwwLDAtLjUuNDIsMy40MiwzLjQyLDAsMCwwLS40NS41OCwzLjMzLDMuMzMsMCwwLDAtLjQ3LDEuMzQsMy40NywzLjQ3LDAsMCwwLDAsMS4wOSwzLjA2LDMuMDYsMCwwLDAsLjQyLDEsMi44OCwyLjg4LDAsMCwwLC42OC43NywzLjk0LDMuOTQsMCwwLDAsMi40Ni43OEgzMjRhOS4xNSw5LjE1LDAsMCwxLDYuNDYsMi4zMyw3LjIsNy4yLDAsMCwxLDEuODksMi43LDkuMzIsOS4zMiwwLDAsMSwuNjEsMy40OWwwLC42YTkuMzQsOS4zNCwwLDAsMS0uNjIsMy40OCw3LjMzLDcuMzMsMCwwLDEtMS44OCwyLjcxQTkuMTMsOS4xMywwLDAsMSwzMjQsNDYzLjloLTkuNDZhNi4xNyw2LjE3LDAsMCwxLTIuNjEtLjUyLDUsNSwwLDAsMS0uOTUtLjU4LDMuODcsMy44NywwLDAsMS0uODQtLjkxLDUuMSw1LjEsMCwwLDEtLjU5LTEuMzEsNi4zLDYuMywwLDAsMS0uMjMtMS43OGgxNC45NGE0LjUxLDQuNTEsMCwwLDAsMS4xLS4yNSw0LjMxLDQuMzEsMCwwLDAsLjk1LS40OSwyLjY5LDIuNjksMCwwLDAsLjgyLS45MSwzLjc5LDMuNzksMCwwLDAsLjQtLjc3LDQuNDEsNC40MSwwLDAsMCwuMTgtLjc0LDMuODgsMy44OCwwLDAsMCwwLS42NywzLjQ5LDMuNDksMCwwLDAtLjA4LS42LDMuNCwzLjQsMCwwLDAtLjUxLTEuMjEsNC42Niw0LjY2LDAsMCwwLS43Ny0uODMsMy42NSwzLjY1LDAsMCwwLS40My0uMzEsMy4wNSwzLjA1LDAsMCwwLS41MS0uMjcsMy44MiwzLjgyLDAsMCwwLS42LS4xOSwzLjExLDMuMTEsMCwwLDAtLjY5LS4wN0gzMTcuMmE4Ljc1LDguNzUsMCwwLDEtNi4yMS0yLjIzLDcuNzIsNy43MiwwLDAsMS0yLjQxLTUuOTVsMC0uNThBNy43OCw3Ljc4LDAsMCwxLDMxMSw0MzYuOGE4Ljg1LDguODUsMCwwLDEsNi4yMS0yLjIzbDkuNzgsMGE1Ljg4LDUuODgsMCwwLDEsMi42MS40OCw1LjExLDUuMTEsMCwwLDEsMSwuNTksMy41MywzLjUzLDAsMCwxLC44My45Miw0LjcxLDQuNzEsMCwwLDEsLjU4LDEuMzQsNi42OCw2LjY4LDAsMCwxLC4yMiwxLjg0WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTM1Myw0MzkuNzZoLTMuMzN2MTkuM2E2LjU2LDYuNTYsMCwwLDEtLjI0LDEuODgsNC45NCw0Ljk0LDAsMCwxLS42MSwxLjM3LDQsNCwwLDAsMS0uODguOTQsNC43NCw0Ljc0LDAsMCwxLTEsLjYsNi4zNSw2LjM1LDAsMCwxLTIuNzQuNDhWNDM5Ljc2aC0zYTcuMjksNy4yOSwwLDAsMS0yLjgxLS41OCw1LjgsNS44LDAsMCwxLTEtLjYxLDQsNCwwLDAsMS0uOS0uOTMsNC43Nyw0Ljc3LDAsMCwxLS42NC0xLjMyLDUuOTQsNS45NCwwLDAsMS0uMjQtMS43OGgyMi43MmE1Ljg5LDUuODksMCwwLDEtLjUzLDIuNjEsNC43NSw0Ljc1LDAsMCwxLS42LDEsMy44NiwzLjg2LDAsMCwxLS45NS44Myw1LjM5LDUuMzksMCwwLDEtMS4zNy41OUE2LjgzLDYuODMsMCwwLDEsMzUzLDQzOS43NloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNDAuNzkgLTE0NC4yNykiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0zNjcuMDYsNDU5YTUuNiw1LjYsMCwwLDEtLjI0LDEuNzMsNC42Miw0LjYyLDAsMCwxLS42MiwxLjI4LDMuNzMsMy43MywwLDAsMS0uODcuOSw0Ljk0LDQuOTQsMCwwLDEtMSwuNTksNi43NCw2Ljc0LDAsMCwxLTIuNzIuNTZWNDM0LjQ4aDIyLjUyYTYuMzQsNi4zNCwwLDAsMS0uMjQsMS44NSw0LjkyLDQuOTIsMCwwLDEtLjY2LDEuMzYsNC4xLDQuMSwwLDAsMS0uOTMuOTMsNS41Niw1LjU2LDAsMCwxLTEuMDYuNTgsNyw3LDAsMCwxLTIuODkuNDVIMzY3LjA2djYuNjZIMzc5YTYuNDgsNi40OCwwLDAsMS0uMjEsMS43NCw1LjI4LDUuMjgsMCwwLDEtLjU3LDEuMzEsNC4yNyw0LjI3LDAsMCwxLS44MS45Miw0LjY1LDQuNjUsMCwwLDEtLjkyLjYyLDYsNiwwLDAsMS0yLjUxLjZoLTYuODhaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzk1LjgxLDQ1My4xM0gzOTIuOXY1LjIxYTkuMTksOS4xOSwwLDAsMS0uMjMsMi4yNCw2LjIzLDYuMjMsMCwwLDEtLjYxLDEuNjIsNC4yNiw0LjI2LDAsMCwxLS44NywxLjA5LDUsNSwwLDAsMS0xLC42Nyw1LjI0LDUuMjQsMCwwLDEtMi43MS40NVY0MzQuNTNoMTMuOTNhMTEuMzUsMTEuMzUsMCwwLDEsMy4zNy40NiwxMC44NiwxMC44NiwwLDAsMSwyLjY3LDEuMTksOS41NSw5LjU1LDAsMCwxLDIsMS42OCwxMS40NSwxMS40NSwwLDAsMSwxLjM5LDEuOTQsOC42OSw4LjY5LDAsMCwxLC44LDEuOTMsNi42NCw2LjY0LDAsMCwxLC4yNiwxLjY5LDExLjg1LDExLjg1LDAsMCwxLS4xNywyLDguMzYsOC4zNiwwLDAsMS0uNTMsMS43Niw4LjExLDguMTEsMCwwLDEtLjg3LDEuNTgsMTIuNjksMTIuNjksMCwwLDEtMS4yMywxLjQ2LDkuNDgsOS40OCwwLDAsMS00LjMzLDIuNDRsLS4wNywwTDQxMi41LDQ2NGgtNi43OGwtNS42NC04LjY3YTMuNjIsMy42MiwwLDAsMC0uODYtMS4xMWMtLjE3LS4xNC0uMzYtLjI3LS41Ny0uNDFhMy45MiwzLjkyLDAsMCwwLS43NC0uMzUsNS41Nyw1LjU3LDAsMCwwLS45NC0uMjVBNS45LDUuOSwwLDAsMCwzOTUuODEsNDUzLjEzWm0xMC42OS05LjcxYTMuMTMsMy4xMywwLDAsMC0uMS0uNzcsMi44NiwyLjg2LDAsMCwwLS4zNC0uODIsMy4zMiwzLjMyLDAsMCwwLS42NC0uNzksMy45NCwzLjk0LDAsMCwwLTEtLjY4LDYuNTgsNi41OCwwLDAsMC0xLjQ0LS40NywxMC4wNywxMC4wNywwLDAsMC0xLjk0LS4xN0gzOTIuOXY2LjE0YTIuNDEsMi40MSwwLDAsMCwuNDYuNzUsMy4wNiwzLjA2LDAsMCwwLC42NS41NCw0LjU0LDQuNTQsMCwwLDAsLjc3LjM3LDcuNjIsNy42MiwwLDAsMCwuODIuMjIsOC43Niw4Ljc2LDAsMCwwLDIsLjE2SDQwMWE2LjY3LDYuNjcsMCwwLDAsMi4zOC0uMzksNC44NCw0Ljg0LDAsMCwwLDEuNzQtMS4xYy4yMi0uMjMuNDItLjQ0LjU5LS42NWEzLjU4LDMuNTgsMCwwLDAsLjQyLS42NSwyLjY2LDIuNjYsMCwwLDAsLjI2LS43NUE0LjI4LDQuMjgsMCwwLDAsNDA2LjUsNDQzLjQyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTQyMi44Miw0NjRoLTUuNDZWNDM0YTYuMjgsNi4yOCwwLDAsMSwyLjc1LjUsNS4yNSw1LjI1LDAsMCwxLDEsLjYzLDQuMTgsNC4xOCwwLDAsMSwuODgsMSw1LjMsNS4zLDAsMCwxLC42MywxLjQ0LDcuMjUsNy4yNSwwLDAsMSwuMjMsMnYzLjI2YzAsLjgsMCwxLjcsMCwyLjY4djMuMDljMCwxLjA3LDAsMi4xNywwLDMuMjl2My4yOGMwLDEuMDcsMCwyLjEsMCwzLjA3djIuNjRjMCwuNzksMCwxLjQ1LDAsMloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNDAuNzkgLTE0NC4yNykiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik00NTMuMjksNDY0LjA2SDQzMC43N1Y0MzQuNDdoMjIuNTJhNiw2LDAsMCwxLS4yNSwxLjg1LDQuMjUsNC4yNSwwLDAsMS0uNjYsMS4zNSw0LDQsMCwwLDEtLjkzLjk0LDUuODIsNS44MiwwLDAsMS0xLjA2LjU4LDcsNywwLDAsMS0yLjg5LjQ1SDQzNi4yMXY2LjY1aDExLjkxYTYuNDYsNi40NiwwLDAsMS0uMjIsMS43NCw0LjYzLDQuNjMsMCwwLDEtLjU3LDEuMzEsNC4yNyw0LjI3LDAsMCwxLS44MS45Miw1LjA2LDUuMDYsMCwwLDEtLjkxLjYyLDYsNiwwLDAsMS0yLjUxLjZoLTYuODl2Ny40MWgxMmE2LjM4LDYuMzgsMCwwLDEsMS43My4yMiw0Ljg4LDQuODgsMCwwLDEsMS4yOC41OSwzLjc4LDMuNzgsMCwwLDEsLjkuODMsNC42OSw0LjY5LDAsMCwxLC42LDFBNi40Myw2LjQzLDAsMCwxLDQ1My4yOSw0NjQuMDZaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNDY2LjE5LDQzOS43MWEzLjUsMy41LDAsMCwwLTEuMTYuMTEsNC41LDQuNSwwLDAsMC0uNTEuMTgsMi41OCwyLjU4LDAsMCwwLS41MS4yOCwyLjQzLDIuNDMsMCwwLDAtLjUuNDIsMywzLDAsMCwwLS40NS41OCwzLjM2LDMuMzYsMCwwLDAtLjQ4LDEuMzQsMy43NywzLjc3LDAsMCwwLC4wNiwxLjA5LDMuMDYsMy4wNiwwLDAsMCwuNDIsMSwyLjcyLDIuNzIsMCwwLDAsLjY4Ljc3LDMuNTYsMy41NiwwLDAsMCwxLC41MywzLjg0LDMuODQsMCwwLDAsMS40OS4yNWg2LjUzYTkuMTgsOS4xOCwwLDAsMSw2LjQ3LDIuMzMsNy4yOSw3LjI5LDAsMCwxLDEuODgsMi43LDkuMzIsOS4zMiwwLDAsMSwuNjIsMy40OWwwLC42YTkuMzQsOS4zNCwwLDAsMS0uNjEsMy40OCw3LjU4LDcuNTgsMCwwLDEtMS44OCwyLjcxLDkuMTcsOS4xNywwLDAsMS02LjQ1LDIuMzFoLTkuNDZhNi4xNiw2LjE2LDAsMCwxLTIuNi0uNTIsNS4xMSw1LjExLDAsMCwxLTEtLjU4LDMuODQsMy44NCwwLDAsMS0uODMtLjkxLDQuNzgsNC43OCwwLDAsMS0uNTktMS4zMSw2LjMsNi4zLDAsMCwxLS4yMy0xLjc4SDQ3M2E0LjcsNC43LDAsMCwwLDEuMTEtLjI1LDQuMjUsNC4yNSwwLDAsMCwuOTQtLjQ5LDIuNzIsMi43MiwwLDAsMCwuODMtLjkxLDMuNzIsMy43MiwwLDAsMCwuMzktLjc3LDMuNjEsMy42MSwwLDAsMCwuMTgtLjc0LDMuMTMsMy4xMywwLDAsMCwwLS42NywzLjQ5LDMuNDksMCwwLDAtLjA4LS42LDMuOCwzLjgsMCwwLDAtLjUxLTEuMjEsNC4zNyw0LjM3LDAsMCwwLS43OC0uODMsNC41Niw0LjU2LDAsMCwwLS40Mi0uMzEsNC4xMSw0LjExLDAsMCwwLS41MS0uMjcsMy42MywzLjYzLDAsMCwwLS42MS0uMTksMywzLDAsMCwwLS42OS0uMDdoLTYuOTNhOC43MSw4LjcxLDAsMCwxLTYuMjEtMi4yMyw3LjY4LDcuNjgsMCwwLDEtMi40MS01Ljk1bDAtLjU4YTcuNzgsNy43OCwwLDAsMSwyLjM5LTUuOTMsOC44MSw4LjgxLDAsMCwxLDYuMjEtMi4yM2w5Ljc4LDBhNS44Niw1Ljg2LDAsMCwxLDIuNi40OCw0Ljg3LDQuODcsMCwwLDEsMSwuNTksMy41MywzLjUzLDAsMCwxLC44My45Miw1LDUsMCwwLDEsLjU4LDEuMzQsNi42OCw2LjY4LDAsMCwxLC4yMiwxLjg0WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTUwOS41Nyw0NjRINDg3LjIyVjQzNC40OGg1LjQydjI0LjM3aDExLjVhNyw3LDAsMCwxLDEuODguMjIsNS4wNiw1LjA2LDAsMCwxLDEuMzkuNTksNCw0LDAsMCwxLDEsLjgzLDQuODMsNC44MywwLDAsMSwuNjMuOTRBNS44NSw1Ljg1LDAsMCwxLDUwOS41Nyw0NjRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTMzLjYxLDQ1OC42NmwtNy44LDBhNi4yOCw2LjI4LDAsMCwxLTIuNzMtLjQ4LDQuNjQsNC42NCwwLDAsMS0xLS41NywzLjY1LDMuNjUsMCwwLDEtLjg3LS45Miw0Ljc0LDQuNzQsMCwwLDEtLjYyLTEuMzIsNi41NSw2LjU1LDAsMCwxLS4yMy0xLjgyaDEzLjI4di02YTEwLjgzLDEwLjgzLDAsMCwwLS41NS0zLjU5LDcuODcsNy44NywwLDAsMC0xLjYzLTIuNzcsNy4xNyw3LjE3LDAsMCwwLTUuNDktMi4zOCw3LjYsNy42LDAsMCwwLTMsLjU5LDYuOTIsNi45MiwwLDAsMC0yLjQ1LDEuNzksOSw5LDAsMCwwLTIuMTksNi4zNlY0NjRoLTUuNVY0NDYuMzhhMTIuNjMsMTIuNjMsMCwwLDEsNy45LTExLjg0LDE1LjM3LDE1LjM3LDAsMCwxLDEwLjUzLDAsMTIuMDgsMTIuMDgsMCwwLDEsNC4xOSwyLjgxLDEyLjM2LDEyLjM2LDAsMCwxLDMuNzIsOVY0NjRoLTUuNTF2LTUuMzdaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTY4LjQ2LDQzOS42OHYxNi45NWMwLC44OC4wNiwxLjY3LDAsMi4zNnMtLjA2LDEuMy0uMTIsMS44NGExMi41NCwxMi41NCwwLDAsMS0uMjIsMS4zOCw2LjI2LDYuMjYsMCwwLDEtLjI4LDEsMi41NCwyLjU0LDAsMCwxLS44NCwxLjI4bC0xNy41OS0xNy42NXYxNy40OWE0LjI2LDQuMjYsMCwwLDEtMi43OC0uMzEsNC4xNiw0LjE2LDAsMCwxLTEtLjc1LDQuOCw0LjgsMCwwLDEtLjg5LTEuMjksOC4yMSw4LjIxLDAsMCwxLS42My0yLDEzLjksMTMuOSwwLDAsMS0uMjQtMi43OHYtMTUuM2EzMC44NSwzMC44NSwwLDAsMSwuMTEtMy44MywxMi45MywxMi45MywwLDAsMSwuMTktMS40MSw4LjQ3LDguNDcsMCwwLDEsLjMxLTEuMjMsMi43NSwyLjc1LDAsMCwxLC40OC0uODcuODguODgsMCwwLDEsLjY4LS4zM2MuMTguMi40Ni40OC44Mi44NWwxLjI2LDEuMzEsMS42MSwxLjY3LDEuODYsMS45MywyLDIuMDksMi4wNiwyLjE0LDcuOTIsOC4yN3YtMTguM2E1LjcyLDUuNzIsMCwwLDEsMi42My40Nyw0LjYsNC42LDAsMCwxLDEsLjYyLDQsNCwwLDAsMSwuODUsMSw1LjA5LDUuMDksMCwwLDEsLjYsMS40M0E3LjU2LDcuNTYsMCwwLDEsNTY4LjQ2LDQzOS42OFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNDAuNzkgLTE0NC4yNykiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik01ODMuMiw0NTguOWg1LjI3YTEyLjIzLDEyLjIzLDAsMCwwLDUtMS4yNiw5LjcxLDkuNzEsMCwwLDAsMS44NC0xLjIxLDgsOCwwLDAsMCwxLjYxLTEuODMsOS42NSw5LjY1LDAsMCwwLDEuMTQtMi41NSwxMiwxMiwwLDAsMCwuNDMtMy40LDYuNTIsNi41MiwwLDAsMC0uMTctMS41NSw4LjM2LDguMzYsMCwwLDAtLjQ0LTEuMzksOC44NCw4Ljg0LDAsMCwwLS42Mi0xLjIzYy0uMjQtLjM3LS40OC0uNzItLjcyLTFhMTEuMTMsMTEuMTMsMCwwLDAtMS45NS0xLjkzLDExLDExLDAsMCwwLTEuNy0uOTQsMTIuNDcsMTIuNDcsMCwwLDAtMS45MS0uNjUsOS4zMiw5LjMyLDAsMCwwLTIuNDQtLjNoLTcuMzRsLS4wNiwyNC40MWgtNS40VjQzNC40N2gxMi40YTE4LjA1LDE4LjA1LDAsMCwxLDYuNDYsMS4wOSwxNC41MSwxNC41MSwwLDAsMSw5LjI3LDEzLjY2LDE0LDE0LDAsMCwxLTQuMjUsMTAuMzVBMTUuMzgsMTUuMzgsMCwwLDEsNTg4LjQ3LDQ2NGE1Ljc0LDUuNzQsMCwwLDEtMi42NC0uNDMsNC4zOSw0LjM5LDAsMCwxLTEtLjU4LDMuNCwzLjQsMCwwLDEtLjg0LS45Miw0LjczLDQuNzMsMCwwLDEtLjYtMS4zNEE2Ljg1LDYuODUsMCwwLDEsNTgzLjIsNDU4LjlaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBvbHlnb24gY2xhc3M9ImNscy0yIiBwb2ludHM9IjE3Ny4zNSAyLjcxIDIzOS4yOCAwIDI3NS43NyA1MC4xMSAzMTYuNTEgOTYuODQgMzAwLjA4IDE1Ni42MiAyODguOTUgMjE3LjYgMjMxLjk2IDI0Mi4wMyAxNzcuMzUgMjcxLjM0IDEyMi43MyAyNDIuMDMgNjUuNzUgMjE3LjYgNTQuNjIgMTU2LjYyIDM4LjE5IDk2Ljg0IDc4LjkyIDUwLjExIDExNS40MiAwIDE3Ny4zNSAyLjcxIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzU3LjgxLDIwNy4xOXM2LjU4LDcsNi41OCwxNC03LjQxLDEwLjI5LTUuNzYsMTYsMTUuMjIsMTguMSwxNS4yMiwxOC4xLDIuNDctMTguNTEsMi4wNi0yMy44Ni0uNDEtMTcuNjktLjQxLTE3LjY5LTEuNjUtOS40NywwLTEwLjI5LDguNjMsNi4xNyw4LjYzLDYuMTcsOC4yMy0yLjQ3LDExLjk0LTEuNjRhNzcuMzIsNzcuMzIsMCwwLDAsOC4yMywxLjIzbDEwLjI4LTUuMzVzLTEuNjQsMTEuMTEtMy4yOSwxMi43NmMwLDAsMi40NiwxMy4xNiwxLjY1LDE2LjQ1czMuNywxNy42OSw4LjIzLDE5Ljc1YzAsMC03LjQyLDguMjMtMS4yNCw3LjgyczQ0LTYuMTcsNjIuOTQsNS43NmMwLDAsMTEuOTQtMTYtNi41Ny0xNC40cy0xOC45My01LjM1LTE4LjkzLTUuMzUtMjkuMjIsNC4xMS0yOS4yMi0xOC4xLDIxLjQtMTkuMzQsMzIuOTItMTkuMzQsMjQuNjktOC42NCwyNC42OS04LjY0LDguMjIsMy4yOSwzLjcsMTAuMjktMTQuODEsOS40Ni0yOC4zOSw5LjQ2LTIxLjgsMS42NC0yMS4zOSw3LjgyLDExLjExLDksMjQuNjksNy44MiwyMS44LDAsMjcuNTYsNS4zNCwxOC45MywyNC4yOC0uODIsMzUuMzhjMCwwLTEuNjUsMTYuNDYuNDEsMTkuNzVzMTAuNywyLjg4LDEwLjcsMi44OHYyOC4zOXMtNS4zNS44Mi01Ljc2LDQuMTItMy43MSw5LjA1LTkuNDcsNS43Ni01LjM1LDEuMjQtMTEuNTIsMS42NC04LjY0LTkuNDYtNi4xNy0xMy41NywxMS4xMS0yLjg5LDE0LjQtMi40Nyw3LS40Miw2LjU4LTMuMjktLjgyLTkuODgtNC45NC05LjQ3LTEwLjI4LTEuNjQtMTQtNy44MS01Ljc2LTE0LjgxLTUuNzYtMTQuODEtMTUuMjIsNy0xMy41OCwxMS45MywzLjcsMTEuMSwzLjcsMTEuMS0xMi43NSw3LjQxLTE2LjQ1LDEyLjM1LTIuNDcsMTEuMS01LjM1LDExLjUyLTkuODgtNi4xOC0xNC00Ljk0LTYuNTksNy05Ljg4LDQuOTQtNS43NS02LjU4LTkuODctNy0yLjg4LTcuODEsMi4wNi0xMS41MSwxMS4xLjQsMTQuODEsMiwxMC43LTIsMTMuMTYtNC45NGEyOS43NSwyOS43NSwwLDAsMCwzLjcxLTUuMzRzLTExLjkzLTUuMzUtMTMuMTctNC4xMiwxMy4xNy0xMC43LDEzLjE3LTEwLjcsOS4wNS03LjgxLDExLjExLTkuODdjMCwwLTMuMjktMi40Ny0xMy4xNywxLjIzcy0xOS4zNCwxMy41OC0yMi42MywxNS42NC03LjQxLTIuODgtNy40MS0yLjg4YTM4LjI4LDM4LjI4LDAsMCwxLTkuODcsOS44OGMtNi4xNyw0LjExLTguMjIsOC42NC0xMi4zNCwxNC4zOXMtMTIuNzYsNy44Mi0xNS42NCwzLjctNi41OC0uODItOS44NywxLjY1LTkuMDUtMS4yMy02LjE2LTEwLjI5LDctNS43NiwxMy4xNi02LjU4LDE1LjYzLTMuNywxNS42My0xNi40NWMwLDAtNC45NC0uODMtMTAuMjgsMy4yOHMtMTIuMzUtNS43NS0xNi44Ny01LjM0UzM0MywyODkuOSwzNDMsMjg5LjlzMTcuNjktMTUuNjQsMTQuNC0xNC44MmE5LjE4LDkuMTgsMCwwLDEtNi4xNy0uODJMMzU3LDI2OC41cy0zLjctOS40Ny01LjM1LTE0LjgxLTEuMjQtMTQtNC45NC0xNS42NC00LjExLTQuMTEtLjgxLTguMjMuNC05LjQ2LDEuMjMtMTIuNzVTMzU1Ljc1LDIwNi4zNywzNTcuODEsMjA3LjE5WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjwvc3ZnPg==") no-repeat bottom;
            width: 100px;
            content: ;
            left:  0;
            position: absolute;
            top: 0;
            }

        ');

        $stylePan->setfavicon($favicon);
        $stylePan->addOrganization($westfriesland);

        $manager->persist($westfriesland);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($stylePan);

        $manager->flush();

        // Begrafenisplanner
        $id = Uuid::fromString('3f44c00e-d919-4f89-bd4c-b730c9b2620a');
        $application = new Application();
        $application->setName('Begrafenisplanner');
        $application->setDescription('Begrafenisplanner');
        $application->setDomain('westfriesland.commonground.nu');
        $application->setOrganization($westfriesland);
        $application->setStyle($stylePan);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id' => $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setOrganization($westfriesland);
        $configuration->setApplication($application);
        $configuration->setConfiguration(
            [
                'loggedIn'          => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'menus', 'id' => 'a8496676-767a-4d1e-beab-be39a7b2c870']),
                'mainMenu'          => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'menus', 'id' => '0ff074bc-e6db-43ed-93ae-c027ad452f78']),
                'home'              => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => '097ea88e-beb6-476e-a978-d07650f03d97']),
                'footer1'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'9e4130de-b2d7-481c-8681-87b2a174c8ae']),
                'footer2'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'e16b153e-de8a-4f24-9886-fd3057ae93de']),
                //'footer3'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'f78d6861-783f-4441-82c4-2efcf5af677f']),
                //'footer4'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'c62eedef-ba28-4a5d-bdea-2eb9ef250b8e']),
                'headerimg'         => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'2c60657d-a728-4e71-897d-ac407c134e10']),
                'changeRequest'     => '7216b69d-e245-488e-af8f-0969241926e7',
                'objectionRequest'  => '2a95ba3e-a3f9-4fdf-8a6d-005d96aad405',
                'orderTemplate'     => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'b92c9562-acdc-40ad-9156-9d98b539d885']),
                'invoiceTemplate'   => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'fc5a7f58-aaf6-4775-bed8-f4ca00c132c0']),
                'login'             => ['eherkening'=>true, 'digispoof'=>true],
                'newsGroup'         => ['4'],
                'userPage'          => 'persoonlijk',
            ]
        );
        $manager->persist($configuration);

        $application->setDefaultConfiguration($configuration);
        $manager->persist($application);
        $manager->flush();

        // loggedIn menu
        $id = Uuid::fromString('a8496676-767a-4d1e-beab-be39a7b2c870');
        $menu = new Menu();
        $menu->setName('loggedIn');
        $menu->setDescription('logged in menu');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id' => $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Mijn West-Friesland');
        $menuItem->setDescription('Stages');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/request');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menu->addMenuItem($menuItem);
        $manager->persist($menu);

        // Menu
        $id = Uuid::fromString('0ff074bc-e6db-43ed-93ae-c027ad452f78');
        $menu = new Menu();
        $menu->setName('Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id' => $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('MenuItem naar home page');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menu->addMenuItem($menuItem);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Zelf regelen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/ptc');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menu->addMenuItem($menuItem);
        $manager->persist($menu);
        $manager->flush();

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($westfriesland);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Template groups
        $groupEmails = new TemplateGroup();
        $groupEmails->setOrganization($westfriesland);
        $groupEmails->setApplication($application);
        $groupEmails->setName('E-mails');
        $groupEmails->setDescription('E-mail messages that are sent by the system');
        $manager->persist($groupEmails);

        // Persoonlijk
        $template = new Template();
        $template->setName('Persoonlijk');
        $template->setDescription('persoonlijke overzichts pagine');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/persoonlijk.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('persoonlijk');
        $slug->setSlug('persoonlijk');
        $manager->persist($slug);

        // Pages
        $id = Uuid::fromString('097ea88e-beb6-476e-a978-d07650f03d97');
        $template = new Template();
        $template->setName('Home');
        $template->setTitle('Home');
        $template->setDescription('De (web) applicatie waarop begravenisen kunnen worden doorgegeven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id' => $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        $id = Uuid::fromString('9e4130de-b2d7-481c-8681-87b2a174c8ae');
        $template = new Template();
        $template->setName('footer1');
        $template->setDescription('Menu met links naar partners en juridische informatie van West-Friesland');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('e16b153e-de8a-4f24-9886-fd3057ae93de');
        $template = new Template();
        $template->setName('footer2');
        $template->setDescription('Menu met links naar gemeenten in West-Friesland');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('f78d6861-783f-4441-82c4-2efcf5af677f');
        $template = new Template();
        $template->setName('footer3');
        $template->setDescription('Formulier voor de nieuwsbrief van West-Friesland over begraven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('3807993a-ed98-4570-8a05-09c9454bcac5');
        $template = new Template();
        $template->setName('HO Akte Grafrecht');
        $template->setDescription('HO Akte Grafrecht document');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Documents/HO_Akte_Grafrecht.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('c62eedef-ba28-4a5d-bdea-2eb9ef250b8e');
        $template = new Template();
        $template->setName('footer4');
        $template->setDescription('Contactgegevens van West-Friesland');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Westfriesland/footers/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('7a3d7d9a-269f-4699-a622-2ad0114d8e86');
        $template = new Template();
        $template->setName('Ontvangst Bevestiging Verzoek');
        $template->setDescription('Ontvangst Bevestiging Verzoek');
        $template->setContent('ontvangen');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('b92c9562-acdc-40ad-9156-9d98b539d885');
        $template = new Template();
        $template->setName('Order');
        $template->setDescription('Order');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Documents/order.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('fc5a7f58-aaf6-4775-bed8-f4ca00c132c0');
        $template = new Template();
        $template->setName('Factuur');
        $template->setDescription('Factuur');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Documents/invoice.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $template = new Template();
        $template->setName('Ingediend verzoek');
        $template->setTitle('Uw verzoek is ontvangen');
        $template->setDescription('Bevestiging dat een verzoek is gewijzigd');
        $template->setContent('Beste {{ receiver.givenName }},<p>Wij hebben uw ingediende verzoek met referentie {{ resource.reference }} succesvol ontvangen. We nemen uw verzoek zo snel mogelijk in behandeling.</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-bevestiging');
        $slug->setSlug('e-mail-bevestiging');
        $manager->persist($slug);
        $manager->flush();

        $template = new Template();
        $template->setName('Verzoek in behandeling');
        $template->setTitle('Uw verzoek is in behandeling genomen');
        $template->setDescription('Bevestiging dat een verzoek is gewijzigd');
        $template->setContent('Beste {{ receiver.givenName }},<p>Wij hebben uw ingediende verzoek met referentie {{ resource.reference }} in behandeling genomen. Wij reageren zo spoedig mogelijk.</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-behandeling');
        $slug->setSlug('e-mail-behandeling');
        $manager->persist($slug);
        $manager->flush();

        $template = new Template();
        $template->setName('Verzoek afgewezen');
        $template->setTitle('Uw verzoek is afgewezen');
        $template->setDescription('Bevestiging dat een verzoek is gewijzigd');
        $template->setContent('Beste {{ receiver.givenName }},<p>Wij hebben uw ingediende verzoek met referentie {{ resource.reference }} helaas moeten afwijzen. U kunt een nieuw verzoek aanmaken, of contact met ons opnemen via</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-afwijzing');
        $slug->setSlug('e-mail-afwijzing');
        $manager->persist($slug);
        $manager->flush();

        $template = new Template();
        $template->setName('Verzoek afgehandeld');
        $template->setTitle('Uw verzoek afgehandeld');
        $template->setDescription('Bevestiging dat een verzoek is gewijzigd');
        $template->setContent('Beste {{ receiver.givenName }},<p>Wij hebben uw ingediende verzoek met referentie {{ resource.reference }} afgehandeld.</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-afgehandeld');
        $slug->setSlug('e-mail-afgehandeldg');
        $manager->persist($slug);
        $manager->flush();

        $template = new Template();
        $template->setName('Ontvangen reservering');
        $template->setTitle('Er is een reservering ontvangen voor uw begraafplaats');
        $template->setDescription('Bevestiging dat een verzoek is gewijzigd');
        $template->setContent('{% set cemetery = resource.properties.begraafplaats %}{% set date = resource.properties.datum %}Beste {{ receiver.givenName }},<p>Er is een verzoek met referentie {{ resource.reference }} aangemaakt met een reservering op de aan u toegewezen begraafplaats {{ begraafplaats.name }} op {{ request.properties.datum|date("d-m-Y om H:i", "Europe/Paris") }}.</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $manager->flush();
        $template->addTemplateGroup($groupEmails);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('e-mail-reservering');
        $slug->setSlug('e-mail-reservering');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('0ae6c667-b8a6-4938-b32e-a06ed1691557');
        $template = new Template();
        $template->setName('E-mail instemming');
        $template->setTitle('Instemming voor een huwelijk');
        $template->setDescription('');
        $template->setContent("{% set receiver = commonground_resource(receiver) %}{% set sender = commonground_resource(sender) %}Beste {{ receiver.givenName }},<br><br>Uw instemming is gevraagd bij een instemmingsverzoek:<p><h2>{{ resource.name }}</h2>{{ resource.description }}</p><a href='{{ resource.forwardUrl }}'>Klik hier</a> om op dit verzoek te reageren.<br><br>Met vriendelijke groet,<br><br>{{ sender.name }}");
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
        $slug->setName('e-mail-instemming');
        $slug->setSlug('e-mail-instemming');
        $manager->persist($slug);
        $manager->flush();

        // Dashboard
        $style = new Style();
        $style->setName('Dashboard');
        $style->setDescription('Huistlijl Westfriese gemeenten West-Friesland');
        $style->setCss(':root {--primary: #233A79;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}.main-title
    	{color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header {background: var(--primary);}
    	.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;}');

        $style->setfavicon($favicon);
        $style->addOrganization($westfriesland);

        $manager->persist($westfriesland);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);
        $manager->flush();

        $id = Uuid::fromString('76298171-e049-4492-ae7b-1d2fe231aa5f');
        $application = new Application();
        $application->setName('Dashboard');
        $application->setDescription('het Dashboard van de gemeente westfriesland');
        $application->setDomain('db.westfriesland.commonground.nu');
        $application->setOrganization($westfriesland);
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id' => $id]);

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('Dashboard');
        $configuration->setDescription('Dashboard van Zuid-Drecht');
        $configuration->setOrganization($westfriesland);
        $configuration->setApplication($application);
        $manager->persist($configuration);
    }
}
