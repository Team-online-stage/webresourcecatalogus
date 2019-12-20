<?php

namespace App\DataFixtures;

use ApiPlatform\Core\Tests\Fixtures\Foo;
use App\Entity\Application;
use App\Entity\Content;
use App\Entity\Footer;
use App\Entity\Header;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Page;
use App\Entity\Slug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $application1 = new Application();
        $content1 = new Content();
        $footer1 = new Footer();
        $header1 = new Header();
        $image1 = new Image();
        $logo1 = new Image();
        $menu1 = new Menu();
        $menuItem1 = new MenuItem();
        $page1 = new Page();
        $slug1 = new Slug();

        $application1->setName("Webshop");
        $application1->setDescription("This application is made with the purpose to have an online functioning webshop.");
        $application1->setDomain("https://www.webshop.nl");
        $application1->addPage($page1);
        $application1->setHeader($header1);
        $application1->setFooter($footer1);
        $application1->addSlug($slug1);

        $slug1->setApplication($application1);
        $slug1->setPage($page1);
        $slug1->setSlug("/about");

        $page1->setTitle("About");
        $page1->setDescription("This page holds info about this application");
        $page1->addContent($content1);
        $page1->setTemplateEngine("twig");
        $page1->setApplication($application1);
        $page1->setSlug($slug1);

        $header1->setLogo($logo1);
        $header1->setMenu($menu1);
        $header1->addImage($image1);
        $header1->setApplication($application1);

        $content1->setData(" A lot of random info over any topic.");
        $content1->addImage($image1);

        $footer1->setLogo($logo1);
        $footer1->setMenu($menu1);
        $footer1->addImage($image1);
        $footer1->setApplication($application1);

        $menu1->setName("webshop-menu");
        $menu1->addMenuItem($menuItem1);
        $menu1->setHeader($header1);
        $menu1->setFooter($footer1);

        $menuItem1 = new MenuItem();
        $menuItem1->setMenu($menu1);
        $menuItem1->setName("about-menu-link");
        $menuItem1->setDescription("This MenuItem links to the about page");
        $menuItem1->setHref("app_home_about");
        $menuItem1->setMenu($menu1);

        $image1->setName("Flowers");
        $image1->setAlt("flowers");
        $image1->setHref("app_img_flowers");
        $image1->setLogo($header1);
        $image1->addHeader($header1);
        $image1->addFooter($footer1);

        $manager->persist($application1);
        $manager->persist($slug1);
        $manager->persist($header1);
        $manager->persist($page1);
        $manager->persist($footer1);
        $manager->persist($menu1);
        $manager->persist($menuItem1);
        $manager->persist($image1);

        $manager->flush();
    }
}
