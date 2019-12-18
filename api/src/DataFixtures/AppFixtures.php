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
        // $product = new Product();
        // $manager->persist($product);

//        $application1 = new Application();
//        $application1->setName("Webshop");
//        $application1->setDescription("This application is made with the purpose to have an online functioning webshop.");
//        $application1->setDomain("https://www.webshop.nl");
//        $manager->persist($application1);
//
//        $content1 = new Content();
//        $content1->setData(" A lot of random info over any topic.");
//        $content1->set
//        $manager->persist($content1);
//
//        $footer1 = new Footer();
//        $manager->persist($footer1);
//
//        $header1 = new Header();
//        $manager->persist($header1);
//
//        $image1 = new Image();
//        $image1->setName("Flowers");
//        $image1->setAlt("flowers");
//        $image1->setHref("app_img_flowers");
//        $manager->persist($image1);
//
//        $menu1 = new Menu();
//        $menu1->setName("webshop-menu");
//        $manager->persist($menu1);
//
//        $menuItem1 = new MenuItem();
//        $menuItem1->setName("about-menu-link");
//        $menuItem1->setDescription("This MenuItem links to the about page");
//        $menuItem1->setHref("app_home_about");
//        $manager->persist($menuItem1);
//
//        $page1 = new Page();
//        $page1->setTitle("About");
//        $page1->setDescription("This page holds info about this application");
//        $page1->setTemplateEngine("twig");
//        $page1->setApplication($application1);
//
//        $slug1 = new Slug();
//        $slug1->setApplication($application1);
//        $slug1->setPage($page1);
//        $slug1->setSlug("/about");

        $manager->flush();
    }
}
