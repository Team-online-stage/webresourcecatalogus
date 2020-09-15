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
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

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
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

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
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

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
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

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
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

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
        $organization->setName('Creative Ground');
        $organization->setDescription('Creative Ground');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('favicon');
        $favicon->setDescription('favicon');
        $favicon->setBase64('data:image/svg+xml;base64,PHN2ZyBpZD0iw5HDq8Ouw6lfMSIgZGF0YS1uYW1lPSLDkcOrw67DqSAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MzkuNTcgMTA5OC44OSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMDA7fS5jbHMtMntmaWxsOiMzNjY5YTU7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT56dWlkIERyZWNodCBOb3BheW9mZjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTc2LDk2Ny4xMWMtNTYsNDEuMzktMTAxLjQzLDY2LjA1LTExMSw3MS4xMWE0LDQsMCwwLDEtMy43MiwwYy0yNS41Ny0xMy41LTMwNy40OC0xNjctMzYxLjM3LTQwNmE0LDQsMCwwLDEsNy4zOC0yLjgxYzM4LjU0LDY4LjkzLDEyNS4zNywxMTkuMjYsMTg3LjUxLDE1Mi42OSw1Mi41LDI4LjIzLDExMy42Miw1MC4yMSwxNjguMzQsODAuMzZDNTA4LjIyLDg4Ny4yOSw1NDksOTE3LjY5LDU3Nyw5NjEuNzVBNCw0LDAsMCwxLDU3Niw5NjcuMTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNODM0LjcxLDIxNS44NFYxMDEuNjVhOC45LDguOSwwLDAsMC04LjktOC45MWgtMjczQTE0LjU5LDE0LjU5LDAsMCwwLDUzOS40MywxMDNsLTE5LDcwLjI4YTE0LjU4LDE0LjU4LDAsMCwxLTEzLjM1LDEwLjIxSDM4M1YxNDcuMTJjMzYuODQtMS4zNCw2Mi40Mi03LjQ1LDgwLjE2LTE1LjEsMjkuNDktMTIuNzQsMzcuMzUtMjkuNzgsMzkuMzYtMzYuNDRhMi4yMiwyLjIyLDAsMCwwLTIuMTMtMi44NEgzMzQuNjFjLTMzLjg4LDAtNjcuOTEsOS4yLTg2LjA4LDQwLjEtMTkuMzgsMzIuOTQtMTguMjQsNzguMDctMTYuNDksMTE0Ljg5LDAsMC01MC02Ni4yMi00MC43Ni0xNDguODdhNS41MSw1LjUxLDAsMCwwLTUuNDgtNi4xMkgxMDAuMzJhOC43OSw4Ljc5LDAsMCwwLTguNzgsOC43OVYxMjRjNC44Niw3OS4yNiw0OS4xNCwyODguNTcsMzcxLjU4LDM4NS40QzczNSw1OTEuMDYsNzc1LjQyLDcxNi4zLDc4My4zMiw3MzguMjRhMS4zOCwxLjM4LDAsMCwwLDIuNTMuMTdjNzUuMy0xNDMuOS04MS40OS0yNDcuNTItODEuNDktMjQ3LjUyLDMxLjMzLDAsNzkuMjMsMTcuOTQsMTE4LDM5Ljc5YTguMjgsOC4yOCwwLDAsMCwxMi4zNy03LjIxVjM2My44M2ExNC42LDE0LjYsMCwwLDAtMTguMTUtMTQuMTdjLTEzLjUsMy4zOS0zMCw2LjY4LTMyLjg3LDcuMjMtMzkuNDYsNy43Ny04NC43NSwxMS4xNS0xMjItOC43M3MtNDcuMjYtNjYuMjctMTguMzMtOTguMjNjMjUuMy0yOCw2NS41My0zNy41LDEwMi4yOS0zNSwyMy41NiwxLjYyLDU1LjE4LDcuNTksNzMuNzEsMTIuNjNBMTIuMTYsMTIuMTYsMCwwLDAsODM0LjcxLDIxNS44NFoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik02NTQuODcsOTAxLjVhNCw0LDAsMCwxLTYtLjExYy0xMy41Ni0xNi4yNS03NS40Ni04Ni0xODUuNzMtMTQ2LjQyQTc1Ni40NCw3NTYuNDQsMCwwLDAsMzgzLDcxN2MtMTczLjUzLTcwLjE3LTI4Mi42OS0xNDMuMy0yOTEuNDItMzM4LjF2LTYuMjJhNCw0LDAsMCwxLDcuMjEtMi4zNGM2My42MSw4NywxNDQuNjksMTM3LjksMjQzLjE2LDE4Ni43Nyw0MC4yOCwyMCw4MS4xNywzNi4zMiwxMjEuMjEsNTMuMjUsNjYuMTUsMjgsMTMwLDU3LjU0LDE4NC43MywxMDcuOCwxNi4xOCwxNC44NSwyOS4wOSwyOS4xNSwzNi44MSw1MEM2OTUuNzUsNzk4LjEzLDcwMi41NSw4NDkuMTcsNjU0Ljg3LDkwMS41WiIvPjwvc3ZnPg==');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

        $style = new Style();
        $style->setName('Creative Ground');
        $style->setDescription('Huistlijl Creative Ground');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        // Dan zuidrecht secifieke dingen
        $organization = $this->getReference(ZuiddrechtFixtures::ORGANIZATION_ZUIDDRECHT);

        $favicon = new Image();
        $favicon->setName('CheckIN Favicon');
        $favicon->setDescription('CheckIN Favicon');
        $favicon->setBase64('data:image/gif;base64,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');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $manager->flush();

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
                'mainMenu'                         => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'f0faccbd-3067-45fb-9ab7-2938fbbbf492']),
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
                'login'                 => ['user'=>true, 'idin'=>true], //, 'facebook'=>true, 'gmail'=>true
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
        $menuItem->setName('Voor ondernemers');
        $menuItem->setDescription('Registreer uw onderneming');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/ondernemers');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Hoe werkt het');
        $menuItem->setDescription('Hoe werkt checkin');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/about');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Privacy');
        $menuItem->setDescription('Wie zitten achter CheckIn');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/privacy');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Voorwaarden');
        $menuItem->setDescription('Wie zitten achter CheckIn');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/proclaimer');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Template groups
        // E-mails
        $groupEmails = new TemplateGroup();
        $groupEmails->setOrganization($organization);
        $groupEmails->setApplication($application);
        $groupEmails->setName('E-mails');
        $groupEmails->setDescription('E-mails that are send out');
        $manager->persist($groupEmails);

        // Invoices
        $groupInvoices = new TemplateGroup();
        $groupInvoices->setOrganization($organization);
        $groupInvoices->setApplication($application);
        $groupInvoices->setName('Invoices');
        $groupInvoices->setDescription('Invoice templates that are filled in using invoices');
        $manager->persist($groupInvoices);

        // E-mail templates
        $id = Uuid::fromString('2ca5b662-e941-46c9-ae87-ae0c68d0aa5d');
        $template = new Template();
        $template->setName('Nieuw verzoek');
        $template->setTitle('U heeft een nieuw verzoek ingediend');
        $template->setDescription('Bevestiging dat u een verzoek heeft ingediend');
        $template->setContent('Beste {{ receiver.givenName }},<p>Uw verzoek met referentie {{ resource.reference }} is met succes ingediend.</p><p>U kunt nu inloggen op https://dev.checking.nu/ met de volgende gegevens:</p><p>Gebruikersnaam: {% if receiver.emails|length >0 %}{% set receiverEmail = receiver.emails[0] %}{% endif %}{% if receiverEmail is defined and receiverEmail is not empty %}{{ receiverEmail.email }}{% endif %}<br>Wachtwoord: test1234</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
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
        $slug->setName('e-mail-indiening');
        $slug->setSlug('e-mail-indiening');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('4016c529-cf9e-415e-abb1-2aba8bfa539e');
        $template = new Template();
        $template->setName('Verzoek geannuleerd');
        $template->setTitle('U heeft uw verzoek geannuleerd');
        $template->setDescription('Bevestiging dat u een verzoek heeft geannuleerd');
        $template->setContent('Beste {{ receiver.givenName }},<p>Uw verzoek met referentie {{ resource.reference }} is geannuleerd.</p><p>Met vriendelijke groet,</p>{{ sender.name }}');
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
        $template->setName('Voorbeeld Factuur');
        $template->setDescription('Een voorbeeld factuur sjabloon');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/facturen/tempVoorbeeld.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupInvoices);
        $manager->persist($template);
        $manager->flush();

        // Pages
        $id = Uuid::fromString('513ee2e3-cf32-4f1e-a85e-ccbe5743c418');
        $template = new Template();
        $template->setName('CheckIn.nu Home');
        $template->setDescription('Homepage voor CheckIn.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/index.html.twig', 'r'));
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
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('8e8007b8-e3c0-4253-ac57-09680789a351');
        $template = new Template();
        $template->setName('Ondernemer');
        $template->setDescription('Informatie voor ondernemers');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/ondernemers.html.twig', 'r'));
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
        $slug->setName('ondernemers');
        $slug->setSlug('ondernemers');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('567f97d8-89dd-4ef3-8119-179ea4001a4f');
        $template = new Template();
        $template->setName('About');
        $template->setDescription('About CheckIng.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/about.html.twig', 'r'));
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
        $slug->setName('about');
        $slug->setSlug('about');
        $manager->persist($slug);
        $manager->flush();

        $id = Uuid::fromString('1374e3da-b4cb-49a7-8969-6bada9f26b12');
        $template = new Template();
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
        $template->setName('verwerkersOvereenkomst');
        $template->setDescription('verwerkersOvereenkomst');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CheckIn/verwerkersOvereenkomst.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);

        /*
         * Then we need some example organizations
         */

        // Zuid-Drecht
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
    }
}
