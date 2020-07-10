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
        $manager->persist($conduction);
        $conduction->setId($id);
        $manager->persist($conduction);
        $manager->flush();
        $conduction = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('Conduction Favicon');
        $favicon->setDescription('Favicon Conduction');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Conduction Logo');
        $logo->setDescription('Logo Conduction');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Conduction');
        $style->setDescription('Huistlijl Conduction');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $conduction->setLogo($logo);

        $manager->persist($conduction);
        $manager->persist($favicon);
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
        $dashboard->setName('Huwelijksplanner');
        $dashboard->setDescription('Huwelijksplanner');
        $dashboard->setDomain('db.conduction.nl');
        $dashboard->setOrganization($conduction);
        $manager->persist($dashboard);
        $dashboard->setId($id);
        $manager->persist($dashboard);
        $manager->flush();
        $dashboard = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        $manager->flush();

        /*
         * ZaakOnline
         */

        $favicon = new Image();
        $favicon->setName('Zaakonline Favicon');
        $favicon->setDescription('Favicon ZaakOnline');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Zaakonline Logo');
        $logo->setDescription('Logo ZaakOnline');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Zaakonline');
        $style->setDescription('Huistlijl ZaakOnline');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
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
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'bb05a4b3-5eca-4cf0-83a9-8fcf41dcc40f']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'6e01b18c-6751-4e11-9430-c69f629a6760']),
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

        $favicon = new Image();
        $favicon->setName('Commonground.nu Favicon');
        $favicon->setDescription('Favicon Commonground.nu');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Commonground.nu Logo');
        $logo->setDescription('Logo Commonground.nu');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('commonground.nu');
        $style->setDescription('Huistlijl commonground.nu');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
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
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'447eb167-17b0-416a-9df4-7cd4d3cc417c']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'83b365c9-33fe-4b89-99d0-d77ef676adb1']),
            ]
        );
        $manager->persist($configuration);

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

        $favicon = new Image();
        $favicon->setName('Common-ground.dev Favicon');
        $favicon->setDescription('Favicon Common-ground.dev');
        $favicon->setOrganization($conduction);

        $logo = new Image();
        $logo->setName('Common-ground.dev Logo');
        $logo->setDescription('Logo Common-ground.dev');
        $logo->setOrganization($conduction);

        $style = new Style();
        $style->setName('Common-ground.dev');
        $style->setDescription('Huistlijl Common-ground.dev');
        $style->setCss('');
        $style->setfavicon($favicon);
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
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
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'15db60f7-76f1-4bc0-8caf-cb9ed9d4066f']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'cdc7b532-2084-470e-9032-935bb8e5bde4']),
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

        $favicon = new Image();
        $favicon->setName('stage Favicon');
        $favicon->setBase64('data:image/svg+xml;base64,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');
        $favicon->setDescription('Favicon stage');
        $favicon->setOrganization($conduction);

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

        $style = new Style();
        $style->setName('stage');
        $style->setDescription('Huistlijl stage');
        $style->setCss(':root {--primary: #ffbc2c;--primary2: black;--secondary: #ffc446;--secondary2: #ffc446;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;}

        .processen i, span {
            color: black;
        }

        a {
            text-decoration: none;
        }

        .footer__nav a {
            color: black !important;
        }

        .footer__nav {
            color: black !important;
        }

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
            background-color: #FFC446;
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


        .header-logo a:after{
            background-image: none;
        }

        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footerStyle {
            background-color: #FFBC2C;
            color: black;
        }

        .nav__link {
            color: black;
        }

        .nav__submenu {
            background-color: #FFBC2C;
        }

        .top-nav-autoresize .nav__link:hover {
            background-color: #ffc446;
            color: black;
        }

        .menuStyle {
            background-color: #ffbc2c;
            color: black;
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
        $style->setOrganization($conduction);

        $manager->persist($conduction);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();
        $id = Uuid::fromString('be1fd311-525b-4408-beb1-012d27af1ff3');
        $stage = new Application();
        $stage->setName('Stage');
        $stage->setDescription('Website voor stage.conduction.nl');
        $stage->setDomain('stage.conduction.nl');
        $stage->setStyle($style);
        $stage->setOrganization($conduction);
        $manager->persist($stage);
        $stage->setId($id);
        $manager->persist($stage);
        $manager->flush();
        $stage = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('stage.conduction.nl configuration');
        $configuration->setOrganization($conduction);
        $configuration->setApplication($stage);
        $configuration->setConfiguration(
            [
                'mainMenu'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'da3d55e3-6b7e-47f3-856d-eb158212d8af']),
                //'loggedOut'         => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'b239cf91-2440-495b-853f-3c1e0fe54ef7']),
                'home'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'6079cc7d-7b69-4db3-ad17-6bf972cca6a2']),
                'footer1'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'09dfc502-19ce-4b11-8e0a-a7fc456a5c52']),
                'footer2'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'23b58ab8-45a6-4fbf-a180-6aac96da4df6']),
                'footer3'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'b86881b2-7911-4598-826d-875acc899845']),
                'footer4'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'b0c69fb9-852f-4c54-80c7-7b0f931e779a']),
                'nieuws'            => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'f2729540-2740-4fbf-98ae-f0a069a1f43f']),
                'newsimg'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'b0e3e803-2cb6-41ed-ab32-d6e5451c119d']),
                'headerimg'         => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'0863d15c-286e-4ec4-90f6-27cebb107aa9']),
                'colorSchemeFooter' => 'footerStyle',
                'colorSchemeMenu'   => 'menuStyle',
            ]
        );
        $manager->persist($configuration);

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
        $menuItem->setHref('/stages');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Tutorials');
        $menuItem->setDescription('Tutorials');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/tutorials');
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
        $menuItem->setHref('/over');
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


//        // LoggedOut Menu
//        $id = Uuid::fromString('b239cf91-2440-495b-853f-3c1e0fe54ef7');
//        $menu = new Menu();
//        $menu->setName('Logged Out Menu');
//        $menu->setDescription('De login opties voor het menuItem inloggen');
//        $menu->setApplication($stage);
//        $manager->persist($menu);
//        $menu->setId($id);
//        $manager->persist($menu);
//        $manager->flush();
//        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);
//
//        $menuItem = new MenuItem();
//        $menuItem->setName('Student');
//        $menuItem->setDescription('Student');
//        $menuItem->setOrder(1);
//        $menuItem->setType('slug');
//        $menuItem->setHref('/home');
//        $menuItem->setMenu($menu);
//        $manager->persist($menuItem);
//
//        $menuItem = new MenuItem();
//        $menuItem->setName('Onderwijsinstelling');
//        $menuItem->setDescription('Onderwijsinstelling');
//        $menuItem->setOrder(2);
//        $menuItem->setType('slug');
//        $menuItem->setHref('/home');
//        $menuItem->setMenu($menu);
//        $manager->persist($menuItem);
//
//        $menuItem = new MenuItem();
//        $menuItem->setName('Gemeente of Organisatie');
//        $menuItem->setDescription('Gemeente of Organisatie');
//        $menuItem->setOrder(3);
//        $menuItem->setType('slug');
//        $menuItem->setHref('/home');
//        $menuItem->setMenu($menu);
//        $manager->persist($menuItem);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($conduction);
        $groupPages->setApplication($stage);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

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
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/over.html.twig', 'r'));
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
        $slug->setName('over');
        $slug->setSlug('over');
        $manager->persist($slug);

        $id = Uuid::fromString('d69ae50c-f7cf-4f42-84c8-88234e87cf2b');
        $template = new Template();
        $template->setName('Opdracht uitzetten');
        $template->setDescription('Stage Opdracht uitzetten Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/opdracht-uitzetten.html.twig', 'r'));
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
        $slug->setName('opdracht-uitzetten');
        $slug->setSlug('opdracht-uitzetten');
        $manager->persist($slug);

        $id = Uuid::fromString('3bfd1aba-c2af-4e50-be81-d7a86c9fe70b');
        $template = new Template();
        $template->setName('Stages');
        $template->setDescription('Stage Stages Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/stages.html.twig', 'r'));
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
        $slug->setName('stages');
        $slug->setSlug('stages');
        $manager->persist($slug);

        $id = Uuid::fromString('73332c62-c2bf-4aeb-a3ca-a397863e1d04');
        $template = new Template();
        $template->setName('Tutorials');
        $template->setDescription('Stage Tutorials Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/tutorials/tutorials.html.twig', 'r'));
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
        $slug->setName('tutorials');
        $slug->setSlug('tutorials');
        $manager->persist($slug);

        $id = Uuid::fromString('4d785bbe-9a17-4c04-a21d-ed9e5a9aeb4b');
        $template = new Template();
        $template->setName('Scrum gericht werken en github');
        $template->setDescription('Dit is een tutorial om je kennis te laten maken met scrum en github');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/tutorials/scrum-github.html.twig', 'r'));
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
        $slug->setName('scrum-github');
        $slug->setSlug('scrum-github');
        $manager->persist($slug);

        $id = Uuid::fromString('2b08aae3-0fae-4abd-a31f-72c9a72dab13');
        $template = new Template();
        $template->setName('Tutorial2');
        $template->setDescription('Dit is een 2de tutorial.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/tutorials/tutorial2.html.twig', 'r'));
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
        $slug->setName('tutorial2');
        $slug->setSlug('tutorial2');
        $manager->persist($slug);

        $id = Uuid::fromString('6264d050-96c7-43cd-93ea-87d421bbf037');
        $template = new Template();
        $template->setName('Tutorial3');
        $template->setDescription('Dit is een 3de tutorial.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/tutorials/tutorial3.html.twig', 'r'));
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
        $slug->setName('tutorial3');
        $slug->setSlug('tutorial3');
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
        $template->setDescription('Stage Oplossingen Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/oplossingen.html.twig', 'r'));
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
        $slug->setName('oplossingen');
        $slug->setSlug('oplossingen');
        $manager->persist($slug);

        $id = Uuid::fromString('bb1ed90e-e529-4f80-a486-5c58583d835c');
        $template = new Template();
        $template->setName('Studenten');
        $template->setDescription('Stage Studenten Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/studenten.html.twig', 'r'));
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
        $slug->setName('studenten');
        $slug->setSlug('studenten');
        $manager->persist($slug);

        $id = Uuid::fromString('c69a6bd9-b233-4d2b-8fd7-9f518c6e7274');
        $template = new Template();
        $template->setName('Student');
        $template->setDescription('Stage Student Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/student.html.twig', 'r'));
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
        $slug->setName('student');
        $slug->setSlug('student');
        $manager->persist($slug);

        $id = Uuid::fromString('89ddaf33-9b5f-4651-9f12-c35122da5a34');
        $template = new Template();
        $template->setName('Teams');
        $template->setDescription('Stage Teams Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/teams.html.twig', 'r'));
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
        $slug->setName('teams');
        $slug->setSlug('teams');
        $manager->persist($slug);

        $id = Uuid::fromString('6520071f-e40e-4a64-bb82-859a1216298e');
        $template = new Template();
        $template->setName('Organisaties');
        $template->setDescription('Stage Organisaties Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/organisaties.html.twig', 'r'));
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
        $slug->setName('organisaties');
        $slug->setSlug('organisaties');
        $manager->persist($slug);

        $id = Uuid::fromString('52118ee2-df4f-4ae2-b535-e481f3eb93a3');
        $template = new Template();
        $template->setName('Organisatie');
        $template->setDescription('Stage Organisatie Page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/organisatie.html.twig', 'r'));
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
        $slug->setName('organisatie');
        $slug->setSlug('organisatie');
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
        $template->setName('pi event');
        $template->setTitle('pi event is van start');
        $template->setDescription('Het Pi event is eindelijk van start! In dit event gaan verschillende gemeentes hun nieuwe platformen tonen.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/pi-event.html.twig', 'r'));
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
        $slug->setName('pi-event');
        $slug->setSlug('pi-event');
        $manager->persist($slug);

        $id = Uuid::fromString('ee7d531b-9245-4cbe-9cef-e1b800cdd3f4');
        $template = new Template();
        $template->setName('corona');
        $template->setTitle('Corona maatregelen in Zuid-drecht');
        $template->setDescription('De corona maatregelingen worden per 1 Juli versoepeld in de gemeente Zuid drecht. De cijfers blijken dusdanig te dalen in deze gemeente dat er weer steeds meer mogenlijk is.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/corona.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P1D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
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
        $slug->setName('corona');
        $slug->setSlug('corona');
        $manager->persist($slug);

        $id = Uuid::fromString('d76116ed-2704-4b9d-8101-2de5cfb343c9');
        $template = new Template();
        $template->setName('Woninginbraak gehalveerd');
        $template->setTitle('Woninginbraak gehalveerd in de gemeente zuid-drecht');
        $template->setDescription('Woning inbraken lijken steeds minder voor te komen in de gemeente Zuid drecht. Uit cijfers blijkt dat dit vergeleken vorig jaar alweer met 50% is gedaald.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Conduction/Stage/nieuws/woning-inbraak.html.twig', 'r'));
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
        $slug->setName('woning-inbraak');
        $slug->setSlug('woning-inbraak');
        $manager->persist($slug);

        $manager->flush();
    }
}
