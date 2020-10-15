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

class ConductionFixtures extends Fixture
{
    private $params;
    /**
     * @var CommonGroundService
     */
    private $commonGroundService;

    public const ORGANIZATION_CONDUCTION = 'organization-conduction';

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'conduction.nl' && strpos($this->params->get('app_domain'), 'conduction.nl') == false) {
            return false;
        }
        //var_dump($this->params->get('app_domain'));

        // Deze organisaties worden ook buiten het wrc gebruikt
        $id = Uuid::fromString('6a001c4c-911b-4b29-877d-122e362f519d');
        $conduction = new Organization();
        $conduction->setName('Conduction');
        $conduction->setDescription('Conduction');
        $conduction->setRsin('');
        $conduction->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'9650a44d-d7d1-454a-ab4f-2338c90e8c2f']));
        $manager->persist($conduction);
        $conduction->setId($id);
        $manager->persist($conduction);
        $manager->flush();
        $conduction = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $this->addReference(self::ORGANIZATION_CONDUCTION, $conduction);

        $id = Uuid::fromString('fa84e88f-dc1e-4d6a-aa0f-e35b5001e017');
        $favicon = new Image();
        $favicon->setName('Conduction Favicon');
        $favicon->setDescription('Favicon Conduction');
        $favicon->setOrganization($conduction);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Conduction Logo');
        $logo->setDescription('Logo Conduction');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Conduction');
        $style->setDescription('Huistlijl Conduction');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($conduction);

        $conduction->setLogo($logo);

        $manager->persist($conduction);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Website applicatie
        $id = Uuid::fromString('7a5e1617-815a-4630-bbb6-994f1c850c28');
        $website = new Application();
        $website->setName('website');
        $website->setDescription('website');
        $website->setDomain('conduction.nl');
        $website->setOrganization($conduction);
        $manager->persist($website);
        $website->setId($id);
        $manager->persist($website);
        $manager->flush();
        $website = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($website);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('928d2632-b52d-49d7-8b5f-814bddf4b18b');
        $template = new Template();
        $template->setName('adres-service');
        $template->setDescription('adres-service');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/adres-service.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('adres-service');
        $slug->setSlug('componenten/adres-service');
        $manager->persist($slug);

        $id = Uuid::fromString('0e83c9ac-0af3-4fbd-b56a-42c97abc317d');
        $template = new Template();
        $template->setName('agenda-service');
        $template->setDescription('agenda-service');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/agenda-service.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('agenda-service');
        $slug->setSlug('componenten/agenda-service');
        $manager->persist($slug);

        $id = Uuid::fromString('8ad226c8-636d-4187-8371-367599068b00');
        $template = new Template();
        $template->setName('bedankt');
        $template->setDescription('bedankt');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/bedankt.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('bedankt');
        $slug->setSlug('bedankt');
        $manager->persist($slug);

        $id = Uuid::fromString('96068066-6923-4b81-ac25-a5d5e632dd82');
        $template = new Template();
        $template->setName('begraven');
        $template->setDescription('begraven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/begraven.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('begraven');
        $slug->setSlug('projecten/begraven');
        $manager->persist($slug);

        $id = Uuid::fromString('89d26cc1-6e54-4bd0-b8b9-b9b21c7a18b0');
        $template = new Template();
        $template->setName('bericht-service');
        $template->setDescription('bericht-service');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/bericht-service.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('bericht-service');
        $slug->setSlug('componenten/bericht-service');
        $manager->persist($slug);

        $id = Uuid::fromString('bdd112f9-ad57-44aa-915f-f8bf09061c3b');
        $template = new Template();
        $template->setName('besmetting-registratie-component');
        $template->setDescription('besmetting-registratie-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/besmetting-registratie-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('besmetting-registratie-component');
        $slug->setSlug('componenten/besmetting-registratie-component');
        $manager->persist($slug);

        $id = Uuid::fromString('8867281a-a7ce-4492-b455-6f7c3eabd201');
        $template = new Template();
        $template->setName('betaal-service');
        $template->setDescription('betaal-service');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/betaal-service.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('betaal-service');
        $slug->setSlug('componenten/betaal-service');
        $manager->persist($slug);

        $id = Uuid::fromString('4b774587-ffc2-4381-8fe8-4511e77ad0b4');
        $template = new Template();
        $template->setName('betaal-service');
        $template->setDescription('betaal-service');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/betaal-service.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('betaal-service');
        $slug->setSlug('componenten/betaal-service');
        $manager->persist($slug);

        $id = Uuid::fromString('6f7a49d2-9fbf-4d7a-a363-2dce7f24c123');
        $template = new Template();
        $template->setName('brp-service');
        $template->setDescription('brp-service');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/brp-service.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('brp-service');
        $slug->setSlug('componenten/brp-service');
        $manager->persist($slug);

        $id = Uuid::fromString('9aed2874-f8de-4220-bca0-46eea7a3cb75');
        $template = new Template();
        $template->setName('buzz');
        $template->setDescription('buzz');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/buzz.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('buzz');
        $slug->setSlug('buzz');
        $manager->persist($slug);

        $id = Uuid::fromString('0954fea5-1ee0-49a6-bd74-50ec6bdd512b');
        $template = new Template();
        $template->setName('caas');
        $template->setDescription('caas');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/caas.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('caas');
        $slug->setSlug('caas');
        $manager->persist($slug);

        $id = Uuid::fromString('2da99fd6-f3bc-4605-8ba4-5b3074c8508c');
        $template = new Template();
        $template->setName('challenges');
        $template->setDescription('challenges');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/chalanges.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('challenges');
        $slug->setSlug('projecten/challenges');
        $manager->persist($slug);

        $id = Uuid::fromString('41125876-c0c5-4b38-a709-7de36a18535f');
        $template = new Template();
        $template->setName('challenge-component');
        $template->setDescription('challenge-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/challenge-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('challenge-component');
        $slug->setSlug('componenten/challenge-component');
        $manager->persist($slug);

        $id = Uuid::fromString('2e67001b-ae74-45f8-8168-02e6f03cc51d');
        $template = new Template();
        $template->setName('commonground');
        $template->setDescription('commonground');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/commonground.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('commonground');
        $slug->setSlug('common-ground');
        $manager->persist($slug);

        $id = Uuid::fromString('0f0c1c30-79c9-4297-894a-701ddf2b501c');
        $template = new Template();
        $template->setName('commonground-dashboard');
        $template->setDescription('commonground-dashboard');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/commonground-dashboard.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('commonground-dashboard');
        $slug->setSlug('componenten/commonground-dashboard');
        $manager->persist($slug);

        $id = Uuid::fromString('a83618de-6792-4a25-98be-89a4d55730c6');
        $template = new Template();
        $template->setName('commonground-registratie-component');
        $template->setDescription('commonground-registratie-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/commonground-registratie-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('commonground-registratie-component');
        $slug->setSlug('componenten/commonground-registratie-component');
        $manager->persist($slug);

        $id = Uuid::fromString('e45f4f69-c8e3-4b89-8be3-9d264c316fa8');
        $template = new Template();
        $template->setName('componenten');
        $template->setDescription('componenten');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/componenten.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('componenten');
        $slug->setSlug('componenten');
        $manager->persist($slug);

        $id = Uuid::fromString('3927aab4-4807-45fd-907d-ab74d9674228');
        $template = new Template();
        $template->setName('contact');
        $template->setDescription('contact');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/contact.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('contact');
        $slug->setSlug('contact');
        $manager->persist($slug);

        $id = Uuid::fromString('bad41b9c-6119-4e92-8292-43a558734cc2');
        $template = new Template();
        $template->setName('contact-catalogus');
        $template->setDescription('contact-catalogus');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/contact-catalogus.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('contact-catalogus');
        $slug->setSlug('componenten/contact-catalogus');
        $manager->persist($slug);

        $id = Uuid::fromString('cee7abce-23b9-41eb-b40e-7e2ada768369');
        $template = new Template();
        $template->setName('contact-moment-catalogus');
        $template->setDescription('contact-moment-catalogus');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/contact-moment-catalogus.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('contact-moment-catalogus');
        $slug->setSlug('componenten/contact-moment-catalogus');
        $manager->persist($slug);

        $id = Uuid::fromString('7d1b26ff-f089-4812-96ce-7f350033d50f');
        $template = new Template();
        $template->setName('corona');
        $template->setDescription('corona');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/corona.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('corona');
        $slug->setSlug('projecten/corona');
        $manager->persist($slug);

        $id = Uuid::fromString('73fe2248-42d6-4010-985e-24396c02c80b');
        $template = new Template();
        $template->setName('digispoof');
        $template->setDescription('digispoof');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/digispoof.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('digispoof');
        $slug->setSlug('componenten/digispoof');
        $manager->persist($slug);

        $id = Uuid::fromString('c53d6ad5-f8cd-45cc-8757-d2757b8379fa');
        $template = new Template();
        $template->setName('docparser');
        $template->setDescription('docparser');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/docparser.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('docparser');
        $slug->setSlug('componenten/docparser');
        $manager->persist($slug);

        $id = Uuid::fromString('dcc0557c-54dc-4bfd-8b80-768088172773');
        $template = new Template();
        $template->setName('environment-component');
        $template->setDescription('environment-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/environment-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('environment-component');
        $slug->setSlug('componenten/environment-component');
        $manager->persist($slug);

        $id = Uuid::fromString('596a034a-7745-4af2-9dfd-5c84c5a71a7a');
        $template = new Template();
        $template->setName('export-component');
        $template->setDescription('export-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/export-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('export-component');
        $slug->setSlug('componenten/export-component');
        $manager->persist($slug);

        $id = Uuid::fromString('a772bdfa-6603-4efa-89be-81825c9999bb');
        $template = new Template();
        $template->setName('formulieren');
        $template->setDescription('formulieren');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/formulieren.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('formulieren');
        $slug->setSlug('projecten/formulieren');
        $manager->persist($slug);

        $id = Uuid::fromString('269bad79-fdaf-48ed-93d0-a59e6234af74');
        $template = new Template();
        $template->setName('home');
        $template->setDescription('home');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/home.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $id = Uuid::fromString('bd765c42-925e-4fc4-b019-7b0c8667771e');
        $template = new Template();
        $template->setName('idealen');
        $template->setDescription('idealen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/idealen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('idealen');
        $slug->setSlug('idealen');
        $manager->persist($slug);

        $id = Uuid::fromString('a7cd20bc-3ba4-4c56-93ed-0a2af21cc6d8');
        $template = new Template();
        $template->setName('landelijke-tabellen-catalogus');
        $template->setDescription('landelijke-tabellen-catalogus');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/landelijke-tabellen-catalogus.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('landelijke-tabellen-catalogus');
        $slug->setSlug('componenten/landelijke-tabellen-catalogus');
        $manager->persist($slug);

        $id = Uuid::fromString('615349ef-d3b4-473e-b0a6-34cb63937be7');
        $template = new Template();
        $template->setName('locatie-component');
        $template->setDescription('locatie-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/locatie-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('locatie-component');
        $slug->setSlug('componenten/locatie-component');
        $manager->persist($slug);

        $id = Uuid::fromString('3d7b6ae5-3e81-44bf-b6d7-62090b3bc8ca');
        $template = new Template();
        $template->setName('medewerker-catalogus');
        $template->setDescription('medewerker-catalogus');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/medewerker-catalogus.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('medewerker-catalogus');
        $slug->setSlug('componenten/medewerker-catalogus');
        $manager->persist($slug);

        $id = Uuid::fromString('1d18fbc1-74c4-48fd-8435-1eb6dc09cc8f');
        $template = new Template();
        $template->setName('memo-component');
        $template->setDescription('memo-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/memo-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('memo-component');
        $slug->setSlug('componenten/memo-component');
        $manager->persist($slug);

        $id = Uuid::fromString('de225fa4-4759-48bd-8fd9-62d0c64ceeeb');
        $template = new Template();
        $template->setName('odyssey');
        $template->setDescription('odyssey');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/odyssey.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('odyssey');
        $slug->setSlug('odyssey');
        $manager->persist($slug);

        $id = Uuid::fromString('32ed9469-7b4d-4e13-9164-60187e5e7021');
        $template = new Template();
        $template->setName('order-registratie-component');
        $template->setDescription('order-registratie-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/order-registratie-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('order-registratie-component');
        $slug->setSlug('componenten/order-registratie-component');
        $manager->persist($slug);

        $id = Uuid::fromString('f34748e9-2816-484f-9c98-b1e7ec60f901');
        $template = new Template();
        $template->setName('partners');
        $template->setDescription('partners');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/partners.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('partners');
        $slug->setSlug('partners');
        $manager->persist($slug);

        $id = Uuid::fromString('4ef772da-4faf-47ab-979b-1b47683c6e6d');
        $template = new Template();
        $template->setName('portfolio-component');
        $template->setDescription('portfolio-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/portfolio-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('portfolio-component');
        $slug->setSlug('componenten/portfolio-component');
        $manager->persist($slug);

        $id = Uuid::fromString('ba414d63-eb65-41c6-981f-58c631894cb5');
        $template = new Template();
        $template->setName('proces-type-catalogus');
        $template->setDescription('proces-type-catalogus');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/proces-type-catalogus.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('proces-type-catalogus');
        $slug->setSlug('componenten/proces-type-catalogus');
        $manager->persist($slug);

        $id = Uuid::fromString('e50fd07b-b32b-461e-9b5e-65eb4a902a41');
        $template = new Template();
        $template->setName('producten-diensten-component');
        $template->setDescription('producten-diensten-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/producten-diensten-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('producten-diensten-component');
        $slug->setSlug('componenten/producten-diensten-component');
        $manager->persist($slug);

        $id = Uuid::fromString('eb84cb67-bcc9-4309-9a17-0bd7b7fe35a3');
        $template = new Template();
        $template->setName('projecten');
        $template->setDescription('projecten');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/projecten.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('projecten');
        $slug->setSlug('projecten');
        $manager->persist($slug);

        $id = Uuid::fromString('30719c6c-a14c-45cd-bf54-11d7fc27c106');
        $template = new Template();
        $template->setName('proto-applicatie');
        $template->setDescription('proto-applicatie');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/proto-applicatie.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('proto-applicatie');
        $slug->setSlug('componenten/proto-applicatie');
        $manager->persist($slug);

        $id = Uuid::fromString('855e4b21-c2c3-4674-a13f-dfc750c69e1e');
        $template = new Template();
        $template->setName('proto-component-commonground');
        $template->setDescription('proto-component-commonground');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/proto-component-commonground.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('proto-component-commonground');
        $slug->setSlug('componenten/proto-component-commonground');
        $manager->persist($slug);

        $id = Uuid::fromString('32c96831-84c3-414f-826d-adcc249299e0');
        $template = new Template();
        $template->setName('queue-component');
        $template->setDescription('queue-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/queue-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('queue-component');
        $slug->setSlug('componenten/queue-component');
        $manager->persist($slug);

        $id = Uuid::fromString('750df354-96d9-4202-8e65-68048d7341b0');
        $template = new Template();
        $template->setName('review-component');
        $template->setDescription('review-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/review-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('review-component');
        $slug->setSlug('componenten/review-component');
        $manager->persist($slug);

        $id = Uuid::fromString('d1f80f13-0503-4fb6-87fe-cb8e86355ce8');
        $template = new Template();
        $template->setName('stage');
        $template->setDescription('stage');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/stage.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('stage');
        $slug->setSlug('projecten/digitale-stages');
        $manager->persist($slug);

        $id = Uuid::fromString('b7247a12-c9b0-42bd-997f-603e25f6d053');
        $template = new Template();
        $template->setName('stuf-component');
        $template->setDescription('stuf-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/stuf-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('stuf-component');
        $slug->setSlug('componenten/stuf-component');
        $manager->persist($slug);

        $id = Uuid::fromString('407a213c-aa71-4f0a-a875-6a66befab70f');
        $template = new Template();
        $template->setName('taken-component');
        $template->setDescription('taken-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/taken-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('taken-component');
        $slug->setSlug('componenten/taken-component');
        $manager->persist($slug);

        $id = Uuid::fromString('10f9dcd4-1d22-4334-9f27-51754f696368');
        $template = new Template();
        $template->setName('team');
        $template->setDescription('team');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/team.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('team');
        $slug->setSlug('team');
        $manager->persist($slug);

        $id = Uuid::fromString('f21b5ab0-7d1b-49bf-8d1e-1f4dceaa1b30');
        $template = new Template();
        $template->setName('trouwen');
        $template->setDescription('trouwen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/trouwen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('trouwen');
        $slug->setSlug('projecten/trouwen');
        $manager->persist($slug);

        $id = Uuid::fromString('9a2c5259-64f2-44f9-8b6f-64b0e8927725');
        $template = new Template();
        $template->setName('user-component');
        $template->setDescription('user-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/user-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('user-component');
        $slug->setSlug('componenten/user-component');
        $manager->persist($slug);

        $id = Uuid::fromString('2307ebfc-ae61-45b1-ac60-e73514d3591c');
        $template = new Template();
        $template->setName('vacatures');
        $template->setDescription('vacatures');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/vacatures.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('vacatures');
        $slug->setSlug('vacatures');
        $manager->persist($slug);

        $id = Uuid::fromString('9bd54383-b431-4e32-a607-925b0cc86901');
        $template = new Template();
        $template->setName('verhuizen');
        $template->setDescription('verhuizen');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/verhuizen.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('verhuizen');
        $slug->setSlug('projecten/verhuizen');
        $manager->persist($slug);

        $id = Uuid::fromString('f478d37a-d7d9-4377-94d4-de6f3f46e113');
        $template = new Template();
        $template->setName('verzoek-registratie-component');
        $template->setDescription('verzoek-registratie-component');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/verzoek-registratie-component.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('verzoek-registratie-component');
        $slug->setSlug('componenten/verzoek-registratie-component');
        $manager->persist($slug);

        $id = Uuid::fromString('dc06c4c9-89d6-489a-995d-0658123e6948');
        $template = new Template();
        $template->setName('verzoek-type-catalogus');
        $template->setDescription('verzoek-type-catalogus');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/verzoek-type-catalogus.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('verzoek-type-catalogus');
        $slug->setSlug('componenten/verzoek-type-catalogus');
        $manager->persist($slug);

        $id = Uuid::fromString('82aa8245-a0fe-4ef3-b9ba-9402e11af337');
        $template = new Template();
        $template->setName('vrijwilligers');
        $template->setDescription('vrijwilligers');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/vrijwilligers.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('vrijwilligers');
        $slug->setSlug('projecten/vrijwilligers');
        $manager->persist($slug);

        $id = Uuid::fromString('999a2f5f-802f-4f9b-a5db-b6360cd32a52');
        $template = new Template();
        $template->setName('web-resource-catalogus');
        $template->setDescription('web-resource-catalogus');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/pages/web-resource-catalogus.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($website);
        $slug->setName('web-resource-catalogus');
        $slug->setSlug('componenten/web-resource-catalogus');
        $manager->persist($slug);

        // Dashboard applicatie
        $id = Uuid::fromString('6ce4dc4c-3db5-417c-ab15-4b823b81605c');
        $dashboard = new Application();
        $dashboard->setName('Commonground Dashboard');
        $dashboard->setDescription('Commonground Dashboard');
        $dashboard->setDomain('db.conduction.nl');
        $dashboard->setOrganization($conduction);
        $dashboard->setStyle($style);
        $manager->persist($dashboard);
        $dashboard->setId($id);
        $manager->persist($dashboard);
        $manager->flush();
        $dashboard = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        $manager->flush();

        /*
         * ZaakOnline
         */

        $id = Uuid::fromString('204a2de1-3cdd-4e50-8aa6-23fa9e96d97a');
        $favicon = new Image();
        $favicon->setName('Zaakonline Favicon');
        $favicon->setDescription('Favicon ZaakOnline');
        $favicon->setOrganization($conduction);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Zaakonline Logo');
        $logo->setDescription('Logo ZaakOnline');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Zaakonline');
        $style->setDescription('Huistlijl ZaakOnline');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('8bcc5b9d-bc9f-4981-bba5-7441ef51af5e');
        $zaakOnline = new Application();
        $zaakOnline->setName('Zaakonline');
        $zaakOnline->setDescription('Website voor Zaakonline');
        $zaakOnline->setDomain('zaakonline.nl');
        $zaakOnline->setStyle($style);
        $zaakOnline->setOrganization($conduction);
        $manager->persist($zaakOnline);
        $zaakOnline->setId($id);
        $manager->persist($zaakOnline);
        $manager->flush();
        $zaakOnline = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setName('zaakonline configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($zaakOnline);
        $configuration->setConfiguration(
            [
                'mainMenu'      => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'bb05a4b3-5eca-4cf0-83a9-8fcf41dcc40f']),
                'home'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'6e01b18c-6751-4e11-9430-c69f629a6760']),
                'hubspotId'     => '6108438',
                'googleTagId'   => 'G-H2T0ZECZYM',
                'userPage'      => '/persoonlijk',
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('bb05a4b3-5eca-4cf0-83a9-8fcf41dcc40f');
        $menu = new Menu();
        $menu->setName('zaakonline Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($zaakOnline);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Processen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Verzoeken');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/requests');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($zaakOnline);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

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
        $slug->setApplication($zaakOnline);
        $slug->setName('persoonlijk');
        $slug->setSlug('persoonlijk');
        $manager->persist($slug);

        // Pages
        $id = Uuid::fromString('6e01b18c-6751-4e11-9430-c69f629a6760');
        $template = new Template();
        $template->setName('zaakonline Home');
        $template->setDescription('De homepage voor zaakonline');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zaakonline/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($zaakOnline);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        /*
         * Commonground.nu
         */

        $id = Uuid::fromString('ec489213-7f3f-4d31-84be-4dff639cdcb2');
        $favicon = new Image();
        $favicon->setName('Commonground.nu Favicon');
        $favicon->setDescription('Favicon Commonground.nu');
        $favicon->setOrganization($conduction);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Commonground.nu Logo');
        $logo->setDescription('Logo Commonground.nu');
        $logo->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Commonground.nu Logo');
        $logo->setDescription('Logo Commonground.nu');
        $logo->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Commonground.nu Logo');
        $logo->setDescription('Logo Commonground.nu');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('commonground.nu');
        $style->setDescription('Huistlijl commonground.nu');
        $style->setCss(':root {--primary: #4376FC; --menu: #4376FC; --menu-color: white;  --footer: #4376FC; --footer-color: white} #docs-nav {background: var(--primary); color: var(--primarytxtcolor)}
        #footer {background: var(--primary); color: var(--primarytxtcolor) !important} .custom-card{padding: 10px !important;} .custom-slider{margin-bottom: 20px} ');
        $style->setfavicon($favicon);
        $style->addOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('86ca72d4-b40e-45cf-bb8c-1a17ba65ad52');
        $commongroundNu = new Application();
        $commongroundNu->setName('Commonground.nu');
        $commongroundNu->setDescription('Website voor commonground.nu');
        $commongroundNu->setDomain('commonground.nu');
        $commongroundNu->setStyle($style);
        $commongroundNu->setOrganization($conduction);
        $manager->persist($commongroundNu);
        $commongroundNu->setId($id);
        $manager->persist($commongroundNu);
        $manager->flush();
        $commongroundNu = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setName('commonground.nu configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($commongroundNu);
        $configuration->setConfiguration(
            [
                'mainMenu'        => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'447eb167-17b0-416a-9df4-7cd4d3cc417c']),
                'home'            => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'83b365c9-33fe-4b89-99d0-d77ef676adb1']),
                'hubspotId'       => '6108438',
                'googleTagId'     => 'G-X24NEYKVXK',
                'userPage'        => '/persoonlijk',
                'login'           => ['user'=>true],
                'header'          => false,
            ]
        );
        $manager->persist($configuration);
        $commongroundNu->setDefaultConfiguration($configuration);
        $manager->persist($commongroundNu);
        $manager->flush();

        // Menu
        $id = Uuid::fromString('447eb167-17b0-416a-9df4-7cd4d3cc417c');
        $menu = new Menu();
        $menu->setName('commonground.nu Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($commongroundNu);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Processen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Verzoeken');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/requests');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($commongroundNu);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

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
        $slug->setApplication($commongroundNu);
        $slug->setName('persoonlijk');
        $slug->setSlug('persoonlijk');
        $manager->persist($slug);

        // Pages
        $id = Uuid::fromString('83b365c9-33fe-4b89-99d0-d77ef676adb1');
        $template = new Template();
        $template->setName('commonground.nu Home');
        $template->setDescription('Homepage voor commonground.nu');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CommongroundNu/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($commongroundNu);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        /*
         * Common-ground.dev
         */

        $id = Uuid::fromString('c063a188-f328-49a8-845a-8795d03fdc6c');
        $favicon = new Image();
        $favicon->setName('Common-ground.dev Favicon');
        $favicon->setDescription('Favicon Common-ground.dev');
        $favicon->setOrganization($conduction);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Common-ground.dev Logo');
        $logo->setDescription('Logo Common-ground.dev');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Common-ground.dev');
        $style->setDescription('Huistlijl Common-ground.dev');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->addOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('283dc171-605f-4e17-9e75-3d161d4b097c');
        $commongroundDev = new Application();
        $commongroundDev->setName('Common-ground.dev');
        $commongroundDev->setDescription('Website voor common-grond.dev');
        $commongroundDev->setDomain('common-ground.dev');
        $commongroundDev->setStyle($style);
        $commongroundDev->setOrganization($conduction);
        $manager->persist($commongroundDev);
        $commongroundDev->setId($id);
        $manager->persist($commongroundDev);
        $manager->flush();
        $commongroundDev = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setName('common-ground.dev configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($commongroundDev);
        $configuration->setConfiguration(
            [
                'mainMenu'        => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'15db60f7-76f1-4bc0-8caf-cb9ed9d4066f']),
                'home'            => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'cdc7b532-2084-470e-9032-935bb8e5bde4']),
                'hubspotId'       => '6108438',
                'googleTagId'     => 'G-FC090SHG18',
                'userPage'        => '/persoonlijk',
                'header'          => false,
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('15db60f7-76f1-4bc0-8caf-cb9ed9d4066f');
        $menu = new Menu();
        $menu->setName('common-ground.dev Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($commongroundDev);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Processen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Verzoeken');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/requests');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($commongroundDev);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

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
        $slug->setApplication($commongroundDev);
        $slug->setName('persoonlijk');
        $slug->setSlug('persoonlijk');
        $manager->persist($slug);

        // Pages
        $id = Uuid::fromString('cdc7b532-2084-470e-9032-935bb8e5bde4');
        $template = new Template();
        $template->setName('common-ground.dev Home');
        $template->setDescription('Homepage voor common-ground.dev');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/CommongroundDev/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($commongroundDev);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();

        /*
        * stage.conduction.nl
        */

        //organizations voor stage.conduction.nl (behalve Conduction die al is aangemaakt)
        //Partners
        //VNG
        $id = Uuid::fromString('617c9ded-4ff8-4911-b9f0-ccbe6710a985');
        $rocflevoland = new Organization();
        $rocflevoland->setName('VNG');
        $rocflevoland->setDescription('Vereniging van Nederlandse Gemeenten');
        $rocflevoland->setRsin('');
        $rocflevoland->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'80a987a0-a5e0-4aa0-bd90-a931871d9283']));
        $manager->persist($rocflevoland);
        $rocflevoland->setId($id);
        $manager->persist($rocflevoland);
        $manager->flush();
        $rocflevoland = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        //SIDN
        $id = Uuid::fromString('33d7d716-509d-4e69-9cb1-66c1f6f9948f');
        $rocflevoland = new Organization();
        $rocflevoland->setName('SIDN');
        $rocflevoland->setDescription('SIDN');
        $rocflevoland->setRsin('');
        $rocflevoland->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'a30454f9-7e97-4e25-9094-245bab73cf9b']));
        $manager->persist($rocflevoland);
        $rocflevoland->setId($id);
        $manager->persist($rocflevoland);
        $manager->flush();
        $rocflevoland = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        //Participanten
        //ROC Flevoland
        $id = Uuid::fromString('0a4b0573-b44a-4811-b962-a5b8c1aed68f');
        $rocflevoland = new Organization();
        $rocflevoland->setName('ROC Flevoland');
        $rocflevoland->setDescription('ROC van Flevoland');
        $rocflevoland->setRsin('');
        $rocflevoland->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'35e3862b-d446-4541-9780-7bfb19c40e01']));
        $manager->persist($rocflevoland);
        $rocflevoland->setId($id);
        $manager->persist($rocflevoland);
        $manager->flush();
        $rocflevoland = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('9a44efa2-af9b-4019-a128-e697e12f15b9');
        $favicon = new Image();
        $favicon->setName('stage Favicon');
        $favicon->setBase64('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgdmlld0JveD0iMCAwIDcwLjY2NjY2NCA2OS45NTQ5MzMiCiAgIGhlaWdodD0iNjkuOTU0OTMzIgogICB3aWR0aD0iNzAuNjY2NjY0IgogICB4bWw6c3BhY2U9InByZXNlcnZlIgogICBpZD0ic3ZnMiIKICAgdmVyc2lvbj0iMS4xIj48bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGE4Ij48cmRmOlJERj48Y2M6V29yawogICAgICAgICByZGY6YWJvdXQ9IiI+PGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+PGRjOnR5cGUKICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPjwvY2M6V29yaz48L3JkZjpSREY+PC9tZXRhZGF0YT48ZGVmcwogICAgIGlkPSJkZWZzNiIgLz48ZwogICAgIHRyYW5zZm9ybT0ibWF0cml4KDEuMzMzMzMzMywwLDAsLTEuMzMzMzMzMywwLDY5Ljk1NDkzMykiCiAgICAgaWQ9ImcxMCI+PHBhdGgKICAgICAgIGlkPSJwYXRoMTIiCiAgICAgICBzdHlsZT0iZmlsbDojZmZmZmZmO2ZpbGwtb3BhY2l0eToxO2ZpbGwtcnVsZTpub256ZXJvO3N0cm9rZTpub25lIgogICAgICAgZD0iTSAwLDAgSCA1MyBWIDUyLjQ2NiBIIDAgWiIgLz48ZwogICAgICAgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNDIuMjI3NSwxNy4xNTMyKSIKICAgICAgIGlkPSJnMTQiPjxwYXRoCiAgICAgICAgIGlkPSJwYXRoMTYiCiAgICAgICAgIHN0eWxlPSJmaWxsOiM0Mzc2ZmM7ZmlsbC1vcGFjaXR5OjE7ZmlsbC1ydWxlOm5vbnplcm87c3Ryb2tlOm5vbmUiCiAgICAgICAgIGQ9Ik0gMCwwIC0xNS43MjgsLTkuMDgxIC0zMS40NTUsMCBWIDE4LjE2IEwgLTE1LjcyOCwyNy4yNDEgMCwxOC4xNiBaIE0gLTE1LjcyOCwzMy40NTIgLTM2LjgzNCwyMS4yNjYgViAtMy4xMDYgbCAyMS4xMDYsLTEyLjE4NiAyMS4xMDcsMTIuMTg2IHYgMjQuMzcyIHoiIC8+PC9nPjxnCiAgICAgICB0cmFuc2Zvcm09InRyYW5zbGF0ZSgyNi40NDgyLDMyLjM3KSIKICAgICAgIGlkPSJnMTgiPjxwYXRoCiAgICAgICAgIGlkPSJwYXRoMjAiCiAgICAgICAgIHN0eWxlPSJmaWxsOiM0Mzc2ZmM7ZmlsbC1vcGFjaXR5OjE7ZmlsbC1ydWxlOm5vbnplcm87c3Ryb2tlOm5vbmUiCiAgICAgICAgIGQ9Ik0gMCwwIDQuOTQzLC0yLjg1NCAxMC42OTUsMC40NjcgMCw2LjY0MiAtMTEuMDY3LDAuMjUzIHYgLTEyLjc4IEwgMCwtMTguOTE2IDEwLjY5NSwtMTIuNzQxIDQuOTQzLC05LjQyIDAsLTEyLjI3NCAtNS4zMTQsLTkuMjA1IHYgNi4xMzYgeiIgLz48L2c+PC9nPjwvc3ZnPg==');
        $favicon->setDescription('Favicon stage');
        $favicon->setOrganization($conduction);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('b0e3e803-2cb6-41ed-ab32-d6e5451c119d');
        $newsimg = new Image();
        $newsimg->setName('news image');
        $newsimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/afbeeldingen/stage_news.jpg', 'r')));
        $newsimg->setDescription('Stage news');
        $newsimg->setOrganization($conduction);
        $manager->persist($newsimg);
        $newsimg->setId($id);
        $manager->persist($newsimg);
        $manager->flush();
        $newsimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('0863d15c-286e-4ec4-90f6-27cebb107aa9');
        $headerimg = new Image();
        $headerimg->setName('header image');
        $headerimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/afbeeldingen/stage_header.jpg', 'r')));
        $headerimg->setDescription('Stage header');
        $headerimg->setOrganization($conduction);
        $manager->persist($headerimg);
        $headerimg->setId($id);
        $manager->persist($headerimg);
        $manager->flush();
        $headerimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('stage Logo');
        $logo->setDescription('Logo stage');
        $logo->setOrganization($conduction);

        // Stage

        $style = new Style();
        $style->setName('stage');
        $style->setDescription('Huistlijl stage');
        $style->setCss('
        :root {
        --background: #4376FC;
        --menu: #ffffff00;
        --menu-color: white;
        --footer: #4376FC;
        --menu-color: white;
        --primary: #4376FC;
        --primary2: white;
        --secondary: #4376FC;
        --secondary2: white;
        }

        a {
            text-decoration: none;
        }


        /* .processen i, span {
            color: black;
        } */

        a:focus:not(.btn):not(.pagination__link):not(.nav__link){
            background: #FFCC5F;
            outline: none;
            color: black;
        }

        .headerImage {
            margin-top: -20px;
            height: 500px;
            background: none;
            background-size: cover !important;
            background-position: center !important;

        }

        .newsImage {
            display: none;
            margin-top: 50px;
            padding: 25px;
            margin-bottom: -50px;
            background: none;
            background-size: cover !important;
            background-position: center !important;
        }

        #news-1, #news-2, #news-3, #news-4 {
            display: none;
        }

        @media only screen and (min-width: 600px){

            .newsImage {
                display: block;
                margin-top: 50px;
                padding: 25px;

                margin-bottom: -50px;
                background: none;
                background-size: cover !important;
                background-position: center !important;
            }

            #news-1, #news-2 {
                display: block;
            }
        }

        @media only screen and (min-width: 900px){
            #news-3 {
                display: block;
            }
        }

        @media only screen and (min-width: 1200px){
            #news-4 {
                display: block;
            }
        }

        @media only screen and (min-width: 1376px){
            .headerImage {
                margin-top: -20px;
                height: 500px;
                background: none;
                background-size: 100% auto !important;
                background-position: center !important;
            }

            .newsImage {
                margin-top: 35px;
                padding: 25px;
                margin-bottom: -50px;
                background: none;
                background-size: 100% auto !important;
                background-position: center !important;
            }
        }

        .processen ul {
            clear: left;
            padding: 0 .5em
        }

        @media only screen and (min-width: 35em) {


            .processen ul li {
                width: 32%;
                float: left;
                margin-right: 2%
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul {
                padding-right: .8em;
            }

            .processen ul li {
                width: 19%;
                float: left;
                margin-right: 1.25%
            }
        }

        .processen ul li {
            list-style: none;
            margin-top: 0;
            margin-bottom: .6em;
            padding: 0;
            background-image: none
        }

        @media only screen and (min-width: 35em) {
            ,.processen ul li:nth-child(3n) {
                margin-right:0
            }
        }

        @media only screen and (min-width: 60em) {

            .processen ul li:nth-child(5n) {
                margin-right: 0
            }

            .processen:after {
                display: none
            }

        }

        .processen ul li{
            background-image: none;
            padding-left: 0
        }

        @media only screen and (min-width: 35em) {
            .processen ul li {
                width:48%
            }

            .processen {
                margin-left: 17px;
            }


        }

        @media only screen and (min-width: 60em) {
            .processen ul li {
                width:48%;
                float: left;
                margin-bottom: .8em;
                margin-right: 2%;

            }
        }

        @media only screen and (min-width: 35em) {
            .processen ul li:nth-child(2n) {
                margin-right:0
            }
        }

        @media only screen and (min-width: 60em) {

            .processen a {
                min-height: 10.2em
            }
        }

        .processen {
            margin: 0 -1.2em
            margin-top: 25px;
        }

        @media only screen and (min-width: 35em) {
            .processen li:nth-child(3n) {
                margin-right:2%
            }
        }

        @media only screen and (min-width: 60em) {
            ..processen li:nth-child(3n) {
                margin-right:0
            }
        }

        .processen ul {
            margin-top: 0;
            margin-left: 0;
        }

        .processen a {
            display: block;
            text-align: center;
            position: relative;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: #FFBC2C;
            color: black;
            text-decoration: none;
        }

        .processen a:hover {
            background-color: #ffffff;
            border-color: #FFC446;
            transform: scale(1.02)
        }

        .processen a span {
            font-size: 1.25em
        }

        @media only screen and (min-width: 35em) {
            .processen a {
                padding:2.5em .75em .75em;
                min-height: 9em
            }

            .processen a span {
                font-size: 1.125em;
                line-height: 1.2
            }
        }

        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .newsCard {
            margin: 10px auto;
            width: 240px;
            background-color: white;
            padding: 15px;
            height:400px;
        }

        .contact {
            background-color: #ffbc2c;
            float:left;
            width: 100%;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            margin-left: 5px;
        }

        @media only screen and (min-width: 960px) {
            .contact {
                background-color: #ffbc2c;
                float:left;
                width: 33%;
                color: black;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 10px;
                margin-left: 0px;
            }
        }

        .header-logo a:before {
        background: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgdmlld0JveD0iMCAwIDcwLjY2NjY2NCA2OS45NTQ5MzMiCiAgIGhlaWdodD0iNjkuOTU0OTMzIgogICB3aWR0aD0iNzAuNjY2NjY0IgogICB4bWw6c3BhY2U9InByZXNlcnZlIgogICBpZD0ic3ZnMiIKICAgdmVyc2lvbj0iMS4xIj48bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGE4Ij48cmRmOlJERj48Y2M6V29yawogICAgICAgICByZGY6YWJvdXQ9IiI+PGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+PGRjOnR5cGUKICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPjwvY2M6V29yaz48L3JkZjpSREY+PC9tZXRhZGF0YT48ZGVmcwogICAgIGlkPSJkZWZzNiIgLz48ZwogICAgIHRyYW5zZm9ybT0ibWF0cml4KDEuMzMzMzMzMywwLDAsLTEuMzMzMzMzMywwLDY5Ljk1NDkzMykiCiAgICAgaWQ9ImcxMCI+PHBhdGgKICAgICAgIGlkPSJwYXRoMTIiCiAgICAgICBzdHlsZT0iZmlsbDojZmZmZmZmO2ZpbGwtb3BhY2l0eToxO2ZpbGwtcnVsZTpub256ZXJvO3N0cm9rZTpub25lIgogICAgICAgZD0iTSAwLDAgSCA1MyBWIDUyLjQ2NiBIIDAgWiIgLz48ZwogICAgICAgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNDIuMjI3NSwxNy4xNTMyKSIKICAgICAgIGlkPSJnMTQiPjxwYXRoCiAgICAgICAgIGlkPSJwYXRoMTYiCiAgICAgICAgIHN0eWxlPSJmaWxsOiM0Mzc2ZmM7ZmlsbC1vcGFjaXR5OjE7ZmlsbC1ydWxlOm5vbnplcm87c3Ryb2tlOm5vbmUiCiAgICAgICAgIGQ9Ik0gMCwwIC0xNS43MjgsLTkuMDgxIC0zMS40NTUsMCBWIDE4LjE2IEwgLTE1LjcyOCwyNy4yNDEgMCwxOC4xNiBaIE0gLTE1LjcyOCwzMy40NTIgLTM2LjgzNCwyMS4yNjYgViAtMy4xMDYgbCAyMS4xMDYsLTEyLjE4NiAyMS4xMDcsMTIuMTg2IHYgMjQuMzcyIHoiIC8+PC9nPjxnCiAgICAgICB0cmFuc2Zvcm09InRyYW5zbGF0ZSgyNi40NDgyLDMyLjM3KSIKICAgICAgIGlkPSJnMTgiPjxwYXRoCiAgICAgICAgIGlkPSJwYXRoMjAiCiAgICAgICAgIHN0eWxlPSJmaWxsOiM0Mzc2ZmM7ZmlsbC1vcGFjaXR5OjE7ZmlsbC1ydWxlOm5vbnplcm87c3Ryb2tlOm5vbmUiCiAgICAgICAgIGQ9Ik0gMCwwIDQuOTQzLC0yLjg1NCAxMC42OTUsMC40NjcgMCw2LjY0MiAtMTEuMDY3LDAuMjUzIHYgLTEyLjc4IEwgMCwtMTguOTE2IDEwLjY5NSwtMTIuNzQxIDQuOTQzLC05LjQyIDAsLTEyLjI3NCAtNS4zMTQsLTkuMjA1IHYgNi4xMzYgeiIgLz48L2c+PC9nPjwvc3ZnPg==") no-repeat bottom;
        background-size: 120%;
        content: ;
        left:  0;
        position: absolute;
        top: 0;}

        .footer3, .footer4 {
        display: none;
        }

        @media only screen and (min-width: 767px) {
            .footer3 {
                display: block;
            }
        }

        @media only screen and (min-width: 992px) {
            .footer4 {
                display: block;
            }
        }

        .challenge-card-picture {
            display: none;
        }

        @media only screen and (min-width: 1205px) {
            .challenge-card-picture {
                display: block;
            }
        }

        ');
        $style->setfavicon($favicon);
        $style->addOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $configuration = new Configuration();
        $configuration->setName('stage.conduction.nl configuration');
        $configuration->setDescription('De configuratie van de stage applicatie');
        $configuration->setOrganization($conduction);
        $configuration->setConfiguration(
            [
                'mainMenu'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'da3d55e3-6b7e-47f3-856d-eb158212d8af']),
                'loggedOut'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'b239cf91-2440-495b-853f-3c1e0fe54ef7']),
                'loggedIn'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'3d9b7bbd-cc5a-4b88-acd0-682cf506da7c']),
                'home'                  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'6079cc7d-7b69-4db3-ad17-6bf972cca6a2']),
                'footer1'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'09dfc502-19ce-4b11-8e0a-a7fc456a5c52']),
                'footer2'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'23b58ab8-45a6-4fbf-a180-6aac96da4df6']),
                'footer3'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'b86881b2-7911-4598-826d-875acc899845']),
                'footer4'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'b0c69fb9-852f-4c54-80c7-7b0f931e779a']),
                'nieuws'                => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'f2729540-2740-4fbf-98ae-f0a069a1f43f']),
                'newsimg'               => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'b0e3e803-2cb6-41ed-ab32-d6e5451c119d']),
                'headerimg'             => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'0863d15c-286e-4ec4-90f6-27cebb107aa9']),
                'colorSchemeFooter'     => 'footerStyle',
                'colorSchemeMenu'       => 'menuStyle',
                'hubspotId'             => '6108438',
                'googleTagId'           => 'G-2PYCJ13YC4',
                'userPage'              => '/persoonlijk',
                'header'                => false,
                'stickyMenu'            => true,
            ]
        );
        $manager->persist($configuration);

        $id = Uuid::fromString('be1fd311-525b-4408-beb1-012d27af1ff3');
        $stage = new Application();
        $stage->setName('Stage');
        $stage->setDescription('Website voor stage.conduction.nl');
        $stage->setDomain('stage.conduction.nl');
        $stage->setStyle($style);
        $stage->setOrganization($conduction);
        $stage->setDefaultConfiguration($configuration);
        $manager->persist($stage);
        $stage->setId($id);
        $manager->persist($stage);
        $manager->flush();
        $stage = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Menu
        $id = Uuid::fromString('da3d55e3-6b7e-47f3-856d-eb158212d8af');
        $menu = new Menu();
        $menu->setName('stage.conduction.nl Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($stage);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Stages');
        $menuItem->setDescription('Stages');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/education/internships');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Programma\'s');
        $menuItem->setDescription('Programma\'s');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/education/programs');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Challenges');
        $menuItem->setDescription('Challenges');
        $menuItem->setOrder(5);
        $menuItem->setType('slug');
        $menuItem->setHref('/challenges');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Over');
        $menuItem->setDescription('Over');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/about');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('De Home Pagina');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/home');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // LoggedOut Menu
        $id = Uuid::fromString('b239cf91-2440-495b-853f-3c1e0fe54ef7');
        $menu = new Menu();
        $menu->setName('Logged Out Menu');
        $menu->setDescription('De login opties voor het menuItem inloggen wanneer nog niet is ingelogd');
        $menu->setApplication($stage);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Registreren');
        $menuItem->setDescription('Registreren');
        $menuItem->setOrder(0);
        $menuItem->setType('slug');
        $menuItem->setHref('/education/register');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // LoggedIn Menu
        $id = Uuid::fromString('3d9b7bbd-cc5a-4b88-acd0-682cf506da7c');
        $menu = new Menu();
        $menu->setName('Logged In Menu');
        $menu->setDescription('De login opties voor het menuItem inloggen wanneer er al is ingelogd');
        $menu->setApplication($stage);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Mijn overzicht');
        $menuItem->setDescription('Mijn overzicht');
        $menuItem->setOrder(0);
        $menuItem->setType('slug');
        $menuItem->setHref('/education/overview');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($stage);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

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
        $slug->setApplication($stage);
        $slug->setName('persoonlijk');
        $slug->setSlug('persoonlijk');
        $manager->persist($slug);

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
        $slug->setApplication($stage);
        $slug->setName('persoonlijk');
        $slug->setSlug('persoonlijk');
        $manager->persist($slug);

        // Pages
        $id = Uuid::fromString('6079cc7d-7b69-4db3-ad17-6bf972cca6a2');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('Stage Home Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $id = Uuid::fromString('a7cd9c16-4d5c-45bd-a95c-3dd931e53b0e');
        $template = new Template();
        $template->setName('Over');
        $template->setDescription('Stage Over Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/about.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('about');
        $slug->setSlug('about');
        $manager->persist($slug);

        $id = Uuid::fromString('cad4760e-703d-4de6-aefb-1ce11e9ff829');
        $template = new Template();
        $template->setName('Challenges');
        $template->setDescription('Stage Challenges Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/challenges.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('challenges');
        $slug->setSlug('challenges');
        $manager->persist($slug);

        $id = Uuid::fromString('dd50555e-84dd-494b-b812-21c3bb4857b8');
        $template = new Template();
        $template->setName('Challenge');
        $template->setDescription('Stage Challenge Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/challenge.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('challenge');
        $slug->setSlug('challenge');
        $manager->persist($slug);

        $id = Uuid::fromString('c15bc8ea-7489-4885-a35a-1f545c2e7950');
        $template = new Template();
        $template->setName('Oplossingen');
        $template->setDescription('Stage Oplossingen (pitches) Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/pitches.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('solutions');
        $slug->setSlug('solutions');
        $manager->persist($slug);

        $id = Uuid::fromString('bef9c010-a9e6-416c-8b0a-1cc4860f9084');
        $template = new Template();
        $template->setName('Oplossing');
        $template->setDescription('Stage Oplossing (pitch) Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/pitch.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('solution');
        $slug->setSlug('solution');
        $manager->persist($slug);

        $id = Uuid::fromString('09dfc502-19ce-4b11-8e0a-a7fc456a5c52');
        $template = new Template();
        $template->setName('footer1');
        $template->setDescription('footer1');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('23b58ab8-45a6-4fbf-a180-6aac96da4df6');
        $template = new Template();
        $template->setName('footer2');
        $template->setDescription('footer2');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('b86881b2-7911-4598-826d-875acc899845');
        $template = new Template();
        $template->setName('footer3');
        $template->setDescription('footer3');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('b0c69fb9-852f-4c54-80c7-7b0f931e779a');
        $template = new Template();
        $template->setName('footer4');
        $template->setDescription('footer4');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('960dcf02-5fe5-422e-98b7-c68d3d2d8256');
        $template = new Template();
        $template->setName('cookies');
        $template->setDescription('cookies');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/cookies.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('cookies');
        $slug->setSlug('cookies');
        $manager->persist($slug);

        $id = Uuid::fromString('ebf44c6e-976a-47b4-910f-7390d64c717a');
        $template = new Template();
        $template->setName('proclaimer');
        $template->setDescription('proclaimer');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/proclaimer.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('proclaimer');
        $slug->setSlug('proclaimer');
        $manager->persist($slug);

        $id = Uuid::fromString('3c212626-ac3a-4682-b7e5-835fbf5bc000');
        $template = new Template();
        $template->setName('privacy');
        $template->setDescription('privacy');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/privacy.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('privacy');
        $slug->setSlug('privacy');
        $manager->persist($slug);

        $id = Uuid::fromString('17f556f4-105a-44df-a74c-1dccc9f22979');
        $template = new Template();
        $template->setName('nieuwsoverzicht');
        $template->setDescription('nieuwsoverzicht');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/nieuwsoverzicht.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('nieuwsoverzicht');
        $slug->setSlug('nieuwsoverzicht');
        $manager->persist($slug);

        $id = Uuid::fromString('3f19d75d-086e-46ad-a6dc-b7a355deffba');
        $template = new Template();
        $template->setName('article');
        $template->setDescription('article');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/article.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('article');
        $slug->setSlug('article');
        $manager->persist($slug);

        // Template groups
        $id = Uuid::fromString('f2729540-2740-4fbf-98ae-f0a069a1f43f');
        $groupNews = new TemplateGroup();
        $groupNews->setOrganization($conduction);
        $groupNews->setApplication($stage);
        $groupNews->setName('Nieuws');
        $groupNews->setDescription('Webpages about news articles');
        $manager->persist($groupNews);
        $groupNews->setId($id);
        $manager->persist($groupNews);
        $manager->flush();
        $groupNews = $manager->getRepository('App:TemplateGroup')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('21218de7-2750-4ed0-a7bb-9f13906f22b5');
        $template = new Template();
        $template->setName('Overheid');
        $template->setTitle('Overheid geeft 1 miljard euro meer uit aan ICT dan gepland');
        $template->setDescription('De Nederlandse overheid gaat zo\'n 1 miljard euro meer uitgeven aan ICT-projecten dan origineel was gepland.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/overheid.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $date = new \DateTime();
        $date->sub(new \DateInterval('P2D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('overheid');
        $slug->setSlug('overheid');
        $manager->persist($slug);

        $id = Uuid::fromString('ee7d531b-9245-4cbe-9cef-e1b800cdd3f4');
        $template = new Template();
        $template->setName('Gekwalificeerd ICT\'er');
        $template->setTitle('Gekwalificeerde ICT\'er heeft banen voor het uitzoeken');
        $template->setDescription('Werkgevers vinden het steeds moeilijker om geschikt ICT-personeel te vinden. Vaak zijn er wel genoeg mensen die werk in computertechnologie zoeken.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/gekwalificeerd-icter.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('gekwalificeerd-icter');
        $slug->setSlug('gekwalificeerd-icter');
        $manager->persist($slug);

        $id = Uuid::fromString('d76116ed-2704-4b9d-8101-2de5cfb343c9');
        $template = new Template();
        $template->setName('Corona app');
        $template->setTitle('App CoronaMelder vanaf 1 september van start');
        $template->setDescription('De app CoronaMelder moet volgens het ministerie van Volksgezondheid vanaf 1 september van start gaan. Vanaf 17 augustus zou het verkrijgbaar moeten zijn voor zowel Android als iOS.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/corona-app.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($stage);
        $slug->setName('corona-app');
        $slug->setSlug('corona-app');
        $manager->persist($slug);

        $manager->flush();
    }
}
