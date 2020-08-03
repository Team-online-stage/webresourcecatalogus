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
        $westfriesland->setDescription('Samenwerkingsverband Westfriesland');
        $westfriesland->setRsin('1234');
        $westfriesland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => 'b294b0ae-fce4-48d3-bf50-eab1f82ddd7f']));
        $manager->persist($westfriesland);
        $westfriesland->setId($id);
        $manager->persist($westfriesland);
        $manager->flush();
        $westfriesland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Opmeer
        $id = Uuid::fromString('16fd1092-c4d3-4011-8998-0e15e13239cf');
        $opmeer = new Organization();
        $opmeer->setName('Opmeer');
        $opmeer->setDescription('Gemeente Opmeer');
        $opmeer->setRsin('1234');
        $opmeer->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '26dee7a2-0fb6-4cc8-b5f6-0b5e2f8aa789']));
        $manager->persist($opmeer);
        $opmeer->setId($id);
        $manager->persist($opmeer);
        $manager->flush();
        $opmeer = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Medemblik
        $id = Uuid::fromString('429e66ef-4411-4ddb-8b83-c637b37e88b5');
        $medemblik = new Organization();
        $medemblik->setName('Medemblik');
        $medemblik->setDescription('Gemeente Medemblik');
        $medemblik->setRsin('1234');
        $medemblik->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '47c8c694-62bb-4dec-b054-556537e896fe']));
        $manager->persist($medemblik);
        $medemblik->setId($id);
        $manager->persist($medemblik);
        $manager->flush();
        $medemblik = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // SED
        $id = Uuid::fromString('7033eeb4-5c77-4d88-9f40-303b538f176f');
        $sed = new Organization();
        $sed->setName('SED');
        $sed->setDescription('Gemeenten Stede Broec, Enkhuizen en Drechterland');
        $sed->setRsin('1234');
        $sed->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '0012428b-dc06-444a-af20-17d3ee06a916']));
        $manager->persist($sed);
        $sed->setId($id);
        $manager->persist($sed);
        $manager->flush();
        $sed = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Hoorn
        $id = Uuid::fromString('d736013f-ad6d-4885-b816-ce72ac3e1384');
        $hoorn = new Organization();
        $hoorn->setName('Hoorn');
        $hoorn->setDescription('Gemeente Hoorn');
        $hoorn->setRsin('1234');
        $hoorn->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '816395fc-4ba4-4fa5-90e9-780bb14a50c2']));
        $manager->persist($hoorn);
        $hoorn->setId($id);
        $manager->persist($hoorn);
        $manager->flush();
        $hoorn = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

        // Koggenland
        $id = Uuid::fromString('f050292c-973d-46ab-97ae-9d8830a59d15');
        $koggenland = new Organization();
        $koggenland->setName('Koggenland');
        $koggenland->setDescription('Gemeente Koggenland');
        $koggenland->setRsin('1234');
        $koggenland->setContact($this->commonGroundService->cleanUrl(['component' => 'cc', 'type' => 'organizations', 'id' => '5792b63d-afb5-4689-990b-51eec52b663b']));
        $manager->persist($koggenland);
        $koggenland->setId($id);
        $manager->persist($koggenland);
        $manager->flush();
        $koggenland = $manager->getRepository('App:Organization')->findOneBy(['id' => $id]);

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

        $logo = new Image();
        $logo->setName('West-Friesland Logo');
        $logo->setDescription('West-Friesland VNG');
        $logo->setOrganization($westfriesland);

        $style = new Style();
        $style->setName('West-Friesland');
        $style->setDescription('Huistlijl samenwerkingsverband West-Friesland');
        $style->setCss(':root {--primary: #233A79;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}

            .header-logo a:before {
            background: url("data:image/svg+xml;base64,PHN2ZyBpZD0iTGFhZ18xIiBkYXRhLW5hbWU9IkxhYWcgMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMzYzLjA5IDMyMC4zNSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiMyNjMzNzE7fS5jbHMtMntmaWxsOiNmZmNiMDQ7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT5sb2dvIFdlc3Rmcmllc2xhbmQgdmVjdG9yPC90aXRsZT48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0yNjUuNSw0NTIuNDNsNy0xOC40YTUuNDgsNS40OCwwLDAsMSwyLjI2LDEuMzMsNSw1LDAsMCwxLC43Mi45Myw0LjU4LDQuNTgsMCwwLDEsLjQ5LDEuMjMsNiw2LDAsMCwxLC4xNCwxLjU4LDcuNzEsNy43MSwwLDAsMS0uMzMsMmMtLjM4LDEtLjc4LDIuMTEtMS4yLDMuMjNsLTEuMjMsMy4zYy0uNCwxLjA4LS43OSwyLjExLTEuMTYsMy4xbC0xLDIuNjVjLS4zLjc4LS41NCwxLjQzLS43MywxLjk0bC0uMzcsMWMtLjQxLDEuMTEtLjgxLDIuMDgtMS4xOSwyLjlzLS43NCwxLjU0LTEuMDcsMi4xM2ExNi4xMywxNi4xMywwLDAsMS0uOTUsMS41LDgsOCwwLDAsMS0uODEsMSwyLjM0LDIuMzQsMCwwLDEtMS41Ni44NmwtNi4wNi0xNS40Ny02LjA3LDE1LjQ3YTIuMzQsMi4zNCwwLDAsMS0xLjU1LS44Niw3LjIsNy4yLDAsMCwxLS44MS0xLDE0LjI3LDE0LjI3LDAsMCwxLS45NS0xLjVjLS4zNC0uNTktLjY5LTEuMy0xLjA3LTIuMTNzLS43Ni0xLjc5LTEuMTctMi45bC0uMzctMWMtLjE5LS41MS0uNDMtMS4xNi0uNzMtMS45NHMtLjYzLTEuNjYtMS0yLjY1bC0xLjE3LTMuMXEtLjYyLTEuNjItMS4yMy0zLjNsLTEuMjEtMy4yM2E3LjcxLDcuNzEsMCwwLDEtLjMzLTIsNS41OSw1LjU5LDAsMCwxLC4xNS0xLjU4LDQuMjcsNC4yNywwLDAsMSwuNDktMS4yMyw1LjQxLDUuNDEsMCwwLDEsLjcxLS45Myw1LjU4LDUuNTgsMCwwLDEsMi4yNy0xLjMzbDcsMTguNCw3LTE2LjczWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTMwNC41NSw0NjQuMDZIMjgyVjQzNC40N2gyMi41MWE2LDYsMCwwLDEtLjI1LDEuODUsNC40Niw0LjQ2LDAsMCwxLS42NSwxLjM1LDQuMzcsNC4zNywwLDAsMS0uOTMuOTQsNS45LDUuOSwwLDAsMS0xLjA3LjU4LDcsNywwLDAsMS0yLjg4LjQ1SDI4Ny40OHY2LjY1aDExLjlhNi40OCw2LjQ4LDAsMCwxLS4yMSwxLjc0LDQuOTQsNC45NCwwLDAsMS0uNTgsMS4zMSw0LDQsMCwwLDEtLjguOTIsNS41LDUuNSwwLDAsMS0uOTIuNjIsNiw2LDAsMCwxLTIuNTEuNmgtNi44OHY3LjQxaDEyYTYuMyw2LjMsMCwwLDEsMS43Mi4yMiw0LjYsNC42LDAsMCwxLDEuMjguNTksMy44NCwzLjg0LDAsMCwxLC45MS44Myw1LjExLDUuMTEsMCwwLDEsLjU5LDFBNi40Myw2LjQzLDAsMCwxLDMwNC41NSw0NjQuMDZaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzE3LjQ2LDQzOS43MWEzLjU2LDMuNTYsMCwwLDAtMS4xNy4xMSwzLjc5LDMuNzksMCwwLDAtLjUuMTgsMi42NSwyLjY1LDAsMCwwLS41Mi4yOCwyLjcyLDIuNzIsMCwwLDAtLjUuNDIsMy40MiwzLjQyLDAsMCwwLS40NS41OCwzLjMzLDMuMzMsMCwwLDAtLjQ3LDEuMzQsMy40NywzLjQ3LDAsMCwwLDAsMS4wOSwzLjA2LDMuMDYsMCwwLDAsLjQyLDEsMi44OCwyLjg4LDAsMCwwLC42OC43NywzLjk0LDMuOTQsMCwwLDAsMi40Ni43OEgzMjRhOS4xNSw5LjE1LDAsMCwxLDYuNDYsMi4zMyw3LjIsNy4yLDAsMCwxLDEuODksMi43LDkuMzIsOS4zMiwwLDAsMSwuNjEsMy40OWwwLC42YTkuMzQsOS4zNCwwLDAsMS0uNjIsMy40OCw3LjMzLDcuMzMsMCwwLDEtMS44OCwyLjcxQTkuMTMsOS4xMywwLDAsMSwzMjQsNDYzLjloLTkuNDZhNi4xNyw2LjE3LDAsMCwxLTIuNjEtLjUyLDUsNSwwLDAsMS0uOTUtLjU4LDMuODcsMy44NywwLDAsMS0uODQtLjkxLDUuMSw1LjEsMCwwLDEtLjU5LTEuMzEsNi4zLDYuMywwLDAsMS0uMjMtMS43OGgxNC45NGE0LjUxLDQuNTEsMCwwLDAsMS4xLS4yNSw0LjMxLDQuMzEsMCwwLDAsLjk1LS40OSwyLjY5LDIuNjksMCwwLDAsLjgyLS45MSwzLjc5LDMuNzksMCwwLDAsLjQtLjc3LDQuNDEsNC40MSwwLDAsMCwuMTgtLjc0LDMuODgsMy44OCwwLDAsMCwwLS42NywzLjQ5LDMuNDksMCwwLDAtLjA4LS42LDMuNCwzLjQsMCwwLDAtLjUxLTEuMjEsNC42Niw0LjY2LDAsMCwwLS43Ny0uODMsMy42NSwzLjY1LDAsMCwwLS40My0uMzEsMy4wNSwzLjA1LDAsMCwwLS41MS0uMjcsMy44MiwzLjgyLDAsMCwwLS42LS4xOSwzLjExLDMuMTEsMCwwLDAtLjY5LS4wN0gzMTcuMmE4Ljc1LDguNzUsMCwwLDEtNi4yMS0yLjIzLDcuNzIsNy43MiwwLDAsMS0yLjQxLTUuOTVsMC0uNThBNy43OCw3Ljc4LDAsMCwxLDMxMSw0MzYuOGE4Ljg1LDguODUsMCwwLDEsNi4yMS0yLjIzbDkuNzgsMGE1Ljg4LDUuODgsMCwwLDEsMi42MS40OCw1LjExLDUuMTEsMCwwLDEsMSwuNTksMy41MywzLjUzLDAsMCwxLC44My45Miw0LjcxLDQuNzEsMCwwLDEsLjU4LDEuMzQsNi42OCw2LjY4LDAsMCwxLC4yMiwxLjg0WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTM1Myw0MzkuNzZoLTMuMzN2MTkuM2E2LjU2LDYuNTYsMCwwLDEtLjI0LDEuODgsNC45NCw0Ljk0LDAsMCwxLS42MSwxLjM3LDQsNCwwLDAsMS0uODguOTQsNC43NCw0Ljc0LDAsMCwxLTEsLjYsNi4zNSw2LjM1LDAsMCwxLTIuNzQuNDhWNDM5Ljc2aC0zYTcuMjksNy4yOSwwLDAsMS0yLjgxLS41OCw1LjgsNS44LDAsMCwxLTEtLjYxLDQsNCwwLDAsMS0uOS0uOTMsNC43Nyw0Ljc3LDAsMCwxLS42NC0xLjMyLDUuOTQsNS45NCwwLDAsMS0uMjQtMS43OGgyMi43MmE1Ljg5LDUuODksMCwwLDEtLjUzLDIuNjEsNC43NSw0Ljc1LDAsMCwxLS42LDEsMy44NiwzLjg2LDAsMCwxLS45NS44Myw1LjM5LDUuMzksMCwwLDEtMS4zNy41OUE2LjgzLDYuODMsMCwwLDEsMzUzLDQzOS43NloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNDAuNzkgLTE0NC4yNykiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0zNjcuMDYsNDU5YTUuNiw1LjYsMCwwLDEtLjI0LDEuNzMsNC42Miw0LjYyLDAsMCwxLS42MiwxLjI4LDMuNzMsMy43MywwLDAsMS0uODcuOSw0Ljk0LDQuOTQsMCwwLDEtMSwuNTksNi43NCw2Ljc0LDAsMCwxLTIuNzIuNTZWNDM0LjQ4aDIyLjUyYTYuMzQsNi4zNCwwLDAsMS0uMjQsMS44NSw0LjkyLDQuOTIsMCwwLDEtLjY2LDEuMzYsNC4xLDQuMSwwLDAsMS0uOTMuOTMsNS41Niw1LjU2LDAsMCwxLTEuMDYuNTgsNyw3LDAsMCwxLTIuODkuNDVIMzY3LjA2djYuNjZIMzc5YTYuNDgsNi40OCwwLDAsMS0uMjEsMS43NCw1LjI4LDUuMjgsMCwwLDEtLjU3LDEuMzEsNC4yNyw0LjI3LDAsMCwxLS44MS45Miw0LjY1LDQuNjUsMCwwLDEtLjkyLjYyLDYsNiwwLDAsMS0yLjUxLjZoLTYuODhaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzk1LjgxLDQ1My4xM0gzOTIuOXY1LjIxYTkuMTksOS4xOSwwLDAsMS0uMjMsMi4yNCw2LjIzLDYuMjMsMCwwLDEtLjYxLDEuNjIsNC4yNiw0LjI2LDAsMCwxLS44NywxLjA5LDUsNSwwLDAsMS0xLC42Nyw1LjI0LDUuMjQsMCwwLDEtMi43MS40NVY0MzQuNTNoMTMuOTNhMTEuMzUsMTEuMzUsMCwwLDEsMy4zNy40NiwxMC44NiwxMC44NiwwLDAsMSwyLjY3LDEuMTksOS41NSw5LjU1LDAsMCwxLDIsMS42OCwxMS40NSwxMS40NSwwLDAsMSwxLjM5LDEuOTQsOC42OSw4LjY5LDAsMCwxLC44LDEuOTMsNi42NCw2LjY0LDAsMCwxLC4yNiwxLjY5LDExLjg1LDExLjg1LDAsMCwxLS4xNywyLDguMzYsOC4zNiwwLDAsMS0uNTMsMS43Niw4LjExLDguMTEsMCwwLDEtLjg3LDEuNTgsMTIuNjksMTIuNjksMCwwLDEtMS4yMywxLjQ2LDkuNDgsOS40OCwwLDAsMS00LjMzLDIuNDRsLS4wNywwTDQxMi41LDQ2NGgtNi43OGwtNS42NC04LjY3YTMuNjIsMy42MiwwLDAsMC0uODYtMS4xMWMtLjE3LS4xNC0uMzYtLjI3LS41Ny0uNDFhMy45MiwzLjkyLDAsMCwwLS43NC0uMzUsNS41Nyw1LjU3LDAsMCwwLS45NC0uMjVBNS45LDUuOSwwLDAsMCwzOTUuODEsNDUzLjEzWm0xMC42OS05LjcxYTMuMTMsMy4xMywwLDAsMC0uMS0uNzcsMi44NiwyLjg2LDAsMCwwLS4zNC0uODIsMy4zMiwzLjMyLDAsMCwwLS42NC0uNzksMy45NCwzLjk0LDAsMCwwLTEtLjY4LDYuNTgsNi41OCwwLDAsMC0xLjQ0LS40NywxMC4wNywxMC4wNywwLDAsMC0xLjk0LS4xN0gzOTIuOXY2LjE0YTIuNDEsMi40MSwwLDAsMCwuNDYuNzUsMy4wNiwzLjA2LDAsMCwwLC42NS41NCw0LjU0LDQuNTQsMCwwLDAsLjc3LjM3LDcuNjIsNy42MiwwLDAsMCwuODIuMjIsOC43Niw4Ljc2LDAsMCwwLDIsLjE2SDQwMWE2LjY3LDYuNjcsMCwwLDAsMi4zOC0uMzksNC44NCw0Ljg0LDAsMCwwLDEuNzQtMS4xYy4yMi0uMjMuNDItLjQ0LjU5LS42NWEzLjU4LDMuNTgsMCwwLDAsLjQyLS42NSwyLjY2LDIuNjYsMCwwLDAsLjI2LS43NUE0LjI4LDQuMjgsMCwwLDAsNDA2LjUsNDQzLjQyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTQyMi44Miw0NjRoLTUuNDZWNDM0YTYuMjgsNi4yOCwwLDAsMSwyLjc1LjUsNS4yNSw1LjI1LDAsMCwxLDEsLjYzLDQuMTgsNC4xOCwwLDAsMSwuODgsMSw1LjMsNS4zLDAsMCwxLC42MywxLjQ0LDcuMjUsNy4yNSwwLDAsMSwuMjMsMnYzLjI2YzAsLjgsMCwxLjcsMCwyLjY4djMuMDljMCwxLjA3LDAsMi4xNywwLDMuMjl2My4yOGMwLDEuMDcsMCwyLjEsMCwzLjA3djIuNjRjMCwuNzksMCwxLjQ1LDAsMloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNDAuNzkgLTE0NC4yNykiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik00NTMuMjksNDY0LjA2SDQzMC43N1Y0MzQuNDdoMjIuNTJhNiw2LDAsMCwxLS4yNSwxLjg1LDQuMjUsNC4yNSwwLDAsMS0uNjYsMS4zNSw0LDQsMCwwLDEtLjkzLjk0LDUuODIsNS44MiwwLDAsMS0xLjA2LjU4LDcsNywwLDAsMS0yLjg5LjQ1SDQzNi4yMXY2LjY1aDExLjkxYTYuNDYsNi40NiwwLDAsMS0uMjIsMS43NCw0LjYzLDQuNjMsMCwwLDEtLjU3LDEuMzEsNC4yNyw0LjI3LDAsMCwxLS44MS45Miw1LjA2LDUuMDYsMCwwLDEtLjkxLjYyLDYsNiwwLDAsMS0yLjUxLjZoLTYuODl2Ny40MWgxMmE2LjM4LDYuMzgsMCwwLDEsMS43My4yMiw0Ljg4LDQuODgsMCwwLDEsMS4yOC41OSwzLjc4LDMuNzgsMCwwLDEsLjkuODMsNC42OSw0LjY5LDAsMCwxLC42LDFBNi40Myw2LjQzLDAsMCwxLDQ1My4yOSw0NjQuMDZaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNDY2LjE5LDQzOS43MWEzLjUsMy41LDAsMCwwLTEuMTYuMTEsNC41LDQuNSwwLDAsMC0uNTEuMTgsMi41OCwyLjU4LDAsMCwwLS41MS4yOCwyLjQzLDIuNDMsMCwwLDAtLjUuNDIsMywzLDAsMCwwLS40NS41OCwzLjM2LDMuMzYsMCwwLDAtLjQ4LDEuMzQsMy43NywzLjc3LDAsMCwwLC4wNiwxLjA5LDMuMDYsMy4wNiwwLDAsMCwuNDIsMSwyLjcyLDIuNzIsMCwwLDAsLjY4Ljc3LDMuNTYsMy41NiwwLDAsMCwxLC41MywzLjg0LDMuODQsMCwwLDAsMS40OS4yNWg2LjUzYTkuMTgsOS4xOCwwLDAsMSw2LjQ3LDIuMzMsNy4yOSw3LjI5LDAsMCwxLDEuODgsMi43LDkuMzIsOS4zMiwwLDAsMSwuNjIsMy40OWwwLC42YTkuMzQsOS4zNCwwLDAsMS0uNjEsMy40OCw3LjU4LDcuNTgsMCwwLDEtMS44OCwyLjcxLDkuMTcsOS4xNywwLDAsMS02LjQ1LDIuMzFoLTkuNDZhNi4xNiw2LjE2LDAsMCwxLTIuNi0uNTIsNS4xMSw1LjExLDAsMCwxLTEtLjU4LDMuODQsMy44NCwwLDAsMS0uODMtLjkxLDQuNzgsNC43OCwwLDAsMS0uNTktMS4zMSw2LjMsNi4zLDAsMCwxLS4yMy0xLjc4SDQ3M2E0LjcsNC43LDAsMCwwLDEuMTEtLjI1LDQuMjUsNC4yNSwwLDAsMCwuOTQtLjQ5LDIuNzIsMi43MiwwLDAsMCwuODMtLjkxLDMuNzIsMy43MiwwLDAsMCwuMzktLjc3LDMuNjEsMy42MSwwLDAsMCwuMTgtLjc0LDMuMTMsMy4xMywwLDAsMCwwLS42NywzLjQ5LDMuNDksMCwwLDAtLjA4LS42LDMuOCwzLjgsMCwwLDAtLjUxLTEuMjEsNC4zNyw0LjM3LDAsMCwwLS43OC0uODMsNC41Niw0LjU2LDAsMCwwLS40Mi0uMzEsNC4xMSw0LjExLDAsMCwwLS41MS0uMjcsMy42MywzLjYzLDAsMCwwLS42MS0uMTksMywzLDAsMCwwLS42OS0uMDdoLTYuOTNhOC43MSw4LjcxLDAsMCwxLTYuMjEtMi4yMyw3LjY4LDcuNjgsMCwwLDEtMi40MS01Ljk1bDAtLjU4YTcuNzgsNy43OCwwLDAsMSwyLjM5LTUuOTMsOC44MSw4LjgxLDAsMCwxLDYuMjEtMi4yM2w5Ljc4LDBhNS44Niw1Ljg2LDAsMCwxLDIuNi40OCw0Ljg3LDQuODcsMCwwLDEsMSwuNTksMy41MywzLjUzLDAsMCwxLC44My45Miw1LDUsMCwwLDEsLjU4LDEuMzQsNi42OCw2LjY4LDAsMCwxLC4yMiwxLjg0WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTUwOS41Nyw0NjRINDg3LjIyVjQzNC40OGg1LjQydjI0LjM3aDExLjVhNyw3LDAsMCwxLDEuODguMjIsNS4wNiw1LjA2LDAsMCwxLDEuMzkuNTksNCw0LDAsMCwxLDEsLjgzLDQuODMsNC44MywwLDAsMSwuNjMuOTRBNS44NSw1Ljg1LDAsMCwxLDUwOS41Nyw0NjRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTMzLjYxLDQ1OC42NmwtNy44LDBhNi4yOCw2LjI4LDAsMCwxLTIuNzMtLjQ4LDQuNjQsNC42NCwwLDAsMS0xLS41NywzLjY1LDMuNjUsMCwwLDEtLjg3LS45Miw0Ljc0LDQuNzQsMCwwLDEtLjYyLTEuMzIsNi41NSw2LjU1LDAsMCwxLS4yMy0xLjgyaDEzLjI4di02YTEwLjgzLDEwLjgzLDAsMCwwLS41NS0zLjU5LDcuODcsNy44NywwLDAsMC0xLjYzLTIuNzcsNy4xNyw3LjE3LDAsMCwwLTUuNDktMi4zOCw3LjYsNy42LDAsMCwwLTMsLjU5LDYuOTIsNi45MiwwLDAsMC0yLjQ1LDEuNzksOSw5LDAsMCwwLTIuMTksNi4zNlY0NjRoLTUuNVY0NDYuMzhhMTIuNjMsMTIuNjMsMCwwLDEsNy45LTExLjg0LDE1LjM3LDE1LjM3LDAsMCwxLDEwLjUzLDAsMTIuMDgsMTIuMDgsMCwwLDEsNC4xOSwyLjgxLDEyLjM2LDEyLjM2LDAsMCwxLDMuNzIsOVY0NjRoLTUuNTF2LTUuMzdaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTY4LjQ2LDQzOS42OHYxNi45NWMwLC44OC4wNiwxLjY3LDAsMi4zNnMtLjA2LDEuMy0uMTIsMS44NGExMi41NCwxMi41NCwwLDAsMS0uMjIsMS4zOCw2LjI2LDYuMjYsMCwwLDEtLjI4LDEsMi41NCwyLjU0LDAsMCwxLS44NCwxLjI4bC0xNy41OS0xNy42NXYxNy40OWE0LjI2LDQuMjYsMCwwLDEtMi43OC0uMzEsNC4xNiw0LjE2LDAsMCwxLTEtLjc1LDQuOCw0LjgsMCwwLDEtLjg5LTEuMjksOC4yMSw4LjIxLDAsMCwxLS42My0yLDEzLjksMTMuOSwwLDAsMS0uMjQtMi43OHYtMTUuM2EzMC44NSwzMC44NSwwLDAsMSwuMTEtMy44MywxMi45MywxMi45MywwLDAsMSwuMTktMS40MSw4LjQ3LDguNDcsMCwwLDEsLjMxLTEuMjMsMi43NSwyLjc1LDAsMCwxLC40OC0uODcuODguODgsMCwwLDEsLjY4LS4zM2MuMTguMi40Ni40OC44Mi44NWwxLjI2LDEuMzEsMS42MSwxLjY3LDEuODYsMS45MywyLDIuMDksMi4wNiwyLjE0LDcuOTIsOC4yN3YtMTguM2E1LjcyLDUuNzIsMCwwLDEsMi42My40Nyw0LjYsNC42LDAsMCwxLDEsLjYyLDQsNCwwLDAsMSwuODUsMSw1LjA5LDUuMDksMCwwLDEsLjYsMS40M0E3LjU2LDcuNTYsMCwwLDEsNTY4LjQ2LDQzOS42OFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNDAuNzkgLTE0NC4yNykiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik01ODMuMiw0NTguOWg1LjI3YTEyLjIzLDEyLjIzLDAsMCwwLDUtMS4yNiw5LjcxLDkuNzEsMCwwLDAsMS44NC0xLjIxLDgsOCwwLDAsMCwxLjYxLTEuODMsOS42NSw5LjY1LDAsMCwwLDEuMTQtMi41NSwxMiwxMiwwLDAsMCwuNDMtMy40LDYuNTIsNi41MiwwLDAsMC0uMTctMS41NSw4LjM2LDguMzYsMCwwLDAtLjQ0LTEuMzksOC44NCw4Ljg0LDAsMCwwLS42Mi0xLjIzYy0uMjQtLjM3LS40OC0uNzItLjcyLTFhMTEuMTMsMTEuMTMsMCwwLDAtMS45NS0xLjkzLDExLDExLDAsMCwwLTEuNy0uOTQsMTIuNDcsMTIuNDcsMCwwLDAtMS45MS0uNjUsOS4zMiw5LjMyLDAsMCwwLTIuNDQtLjNoLTcuMzRsLS4wNiwyNC40MWgtNS40VjQzNC40N2gxMi40YTE4LjA1LDE4LjA1LDAsMCwxLDYuNDYsMS4wOSwxNC41MSwxNC41MSwwLDAsMSw5LjI3LDEzLjY2LDE0LDE0LDAsMCwxLTQuMjUsMTAuMzVBMTUuMzgsMTUuMzgsMCwwLDEsNTg4LjQ3LDQ2NGE1Ljc0LDUuNzQsMCwwLDEtMi42NC0uNDMsNC4zOSw0LjM5LDAsMCwxLTEtLjU4LDMuNCwzLjQsMCwwLDEtLjg0LS45Miw0LjczLDQuNzMsMCwwLDEtLjYtMS4zNEE2Ljg1LDYuODUsMCwwLDEsNTgzLjIsNDU4LjlaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQwLjc5IC0xNDQuMjcpIi8+PHBvbHlnb24gY2xhc3M9ImNscy0yIiBwb2ludHM9IjE3Ny4zNSAyLjcxIDIzOS4yOCAwIDI3NS43NyA1MC4xMSAzMTYuNTEgOTYuODQgMzAwLjA4IDE1Ni42MiAyODguOTUgMjE3LjYgMjMxLjk2IDI0Mi4wMyAxNzcuMzUgMjcxLjM0IDEyMi43MyAyNDIuMDMgNjUuNzUgMjE3LjYgNTQuNjIgMTU2LjYyIDM4LjE5IDk2Ljg0IDc4LjkyIDUwLjExIDExNS40MiAwIDE3Ny4zNSAyLjcxIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzU3LjgxLDIwNy4xOXM2LjU4LDcsNi41OCwxNC03LjQxLDEwLjI5LTUuNzYsMTYsMTUuMjIsMTguMSwxNS4yMiwxOC4xLDIuNDctMTguNTEsMi4wNi0yMy44Ni0uNDEtMTcuNjktLjQxLTE3LjY5LTEuNjUtOS40NywwLTEwLjI5LDguNjMsNi4xNyw4LjYzLDYuMTcsOC4yMy0yLjQ3LDExLjk0LTEuNjRhNzcuMzIsNzcuMzIsMCwwLDAsOC4yMywxLjIzbDEwLjI4LTUuMzVzLTEuNjQsMTEuMTEtMy4yOSwxMi43NmMwLDAsMi40NiwxMy4xNiwxLjY1LDE2LjQ1czMuNywxNy42OSw4LjIzLDE5Ljc1YzAsMC03LjQyLDguMjMtMS4yNCw3LjgyczQ0LTYuMTcsNjIuOTQsNS43NmMwLDAsMTEuOTQtMTYtNi41Ny0xNC40cy0xOC45My01LjM1LTE4LjkzLTUuMzUtMjkuMjIsNC4xMS0yOS4yMi0xOC4xLDIxLjQtMTkuMzQsMzIuOTItMTkuMzQsMjQuNjktOC42NCwyNC42OS04LjY0LDguMjIsMy4yOSwzLjcsMTAuMjktMTQuODEsOS40Ni0yOC4zOSw5LjQ2LTIxLjgsMS42NC0yMS4zOSw3LjgyLDExLjExLDksMjQuNjksNy44MiwyMS44LDAsMjcuNTYsNS4zNCwxOC45MywyNC4yOC0uODIsMzUuMzhjMCwwLTEuNjUsMTYuNDYuNDEsMTkuNzVzMTAuNywyLjg4LDEwLjcsMi44OHYyOC4zOXMtNS4zNS44Mi01Ljc2LDQuMTItMy43MSw5LjA1LTkuNDcsNS43Ni01LjM1LDEuMjQtMTEuNTIsMS42NC04LjY0LTkuNDYtNi4xNy0xMy41NywxMS4xMS0yLjg5LDE0LjQtMi40Nyw3LS40Miw2LjU4LTMuMjktLjgyLTkuODgtNC45NC05LjQ3LTEwLjI4LTEuNjQtMTQtNy44MS01Ljc2LTE0LjgxLTUuNzYtMTQuODEtMTUuMjIsNy0xMy41OCwxMS45MywzLjcsMTEuMSwzLjcsMTEuMS0xMi43NSw3LjQxLTE2LjQ1LDEyLjM1LTIuNDcsMTEuMS01LjM1LDExLjUyLTkuODgtNi4xOC0xNC00Ljk0LTYuNTksNy05Ljg4LDQuOTQtNS43NS02LjU4LTkuODctNy0yLjg4LTcuODEsMi4wNi0xMS41MSwxMS4xLjQsMTQuODEsMiwxMC43LTIsMTMuMTYtNC45NGEyOS43NSwyOS43NSwwLDAsMCwzLjcxLTUuMzRzLTExLjkzLTUuMzUtMTMuMTctNC4xMiwxMy4xNy0xMC43LDEzLjE3LTEwLjcsOS4wNS03LjgxLDExLjExLTkuODdjMCwwLTMuMjktMi40Ny0xMy4xNywxLjIzcy0xOS4zNCwxMy41OC0yMi42MywxNS42NC03LjQxLTIuODgtNy40MS0yLjg4YTM4LjI4LDM4LjI4LDAsMCwxLTkuODcsOS44OGMtNi4xNyw0LjExLTguMjIsOC42NC0xMi4zNCwxNC4zOXMtMTIuNzYsNy44Mi0xNS42NCwzLjctNi41OC0uODItOS44NywxLjY1LTkuMDUtMS4yMy02LjE2LTEwLjI5LDctNS43NiwxMy4xNi02LjU4LDE1LjYzLTMuNywxNS42My0xNi40NWMwLDAtNC45NC0uODMtMTAuMjgsMy4yOHMtMTIuMzUtNS43NS0xNi44Ny01LjM0UzM0MywyODkuOSwzNDMsMjg5LjlzMTcuNjktMTUuNjQsMTQuNC0xNC44MmE5LjE4LDkuMTgsMCwwLDEtNi4xNy0uODJMMzU3LDI2OC41cy0zLjctOS40Ny01LjM1LTE0LjgxLTEuMjQtMTQtNC45NC0xNS42NC00LjExLTQuMTEtLjgxLTguMjMuNC05LjQ2LDEuMjMtMTIuNzVTMzU1Ljc1LDIwNi4zNywzNTcuODEsMjA3LjE5WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI0MC43OSAtMTQ0LjI3KSIvPjwvc3ZnPg==") no-repeat bottom;
            width: 100px;
            content: ;
            left:  0;
            position: absolute;
            top: 0;
            }

            .header-logo a {
            margin-bottom: 0px !important;
            }

            .header-logo a:after{
            background-image: none;
            }

            .main-title {
                color: var(--primary2) !important;
            }

            .logo-header {
                background: var(--primary);

            }
            .navbar-header{
                background: var(--primary);
            }

            .bg-primary-gradient {
                background: linear-gradient(-45deg, var(--secondary), var(--secondary2)) !important;
            }

            #docs-nav {
                background: var(--primary)
            }

            #footer {
                background: var(--primary)
            }

            .begraaf-card {
                background: var(--primary); text-align:center; padding: 20px !important; margin-bottom: 75px;
            }

            .begraaf-card:active .begraaf-card:visited {
                background: var(--primary) !important
            }

            .top-nav-autoresize .nav__link:hover {
                background: var(--primary)
            }
            .nav__item a {
                background: var(--primary)
        }');

        $style->setfavicon($favicon);
        $style->setOrganization($westfriesland);

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
        $application->setStyle($style);
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
                'loggedIn' => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'menus', 'id' => 'a8496676-767a-4d1e-beab-be39a7b2c870']),
                'mainMenu' => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'menus', 'id' => '0ff074bc-e6db-43ed-93ae-c027ad452f78']),
                'home'     => $this->commonGroundService->cleanUrl(['component' => 'wrc', 'type' => 'templates', 'id' => '097ea88e-beb6-476e-a978-d07650f03d97']),
                'footer1'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'9e4130de-b2d7-481c-8681-87b2a174c8ae']),
                'footer2'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'e16b153e-de8a-4f24-9886-fd3057ae93de']),
                'footer3'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'f78d6861-783f-4441-82c4-2efcf5af677f']),
                'footer4'  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'c62eedef-ba28-4a5d-bdea-2eb9ef250b8e']),
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
        $menuItem->setHref('/process');
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

        // Dashboard
        $style = new Style();
        $style->setName('Dashboard');
        $style->setDescription('Huistlijl samenwerkingsverband West-Friesland');
        $style->setCss(':root {--primary: #233A79;--primary2: white;--secondary: #FFC926;--secondary2: #FFC926;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;} #docs-nav {background: var(--primary)} #footer {background: var(--primary)}
          .begraaf-card {background: var(--primary); text-align:center; padding: 20px !important; margin-bottom: 75px; }
          .begraaf-card:active .begraaf-card:visited {background var(--primary) !important}
          .header-logo{text-align: left !important; padding: 15px 0 5px 0px} .top-nav-autoresize .nav__link:hover {background: var(--primary)}
          .nav__item a {background: var(--primary)}');

        $style->setfavicon($favicon);
        $style->setOrganization($westfriesland);

        $application->setStyle($style);
        $manager->persist($application);

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
