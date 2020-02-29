<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use App\Entity\Style;
use App\Entity\Application;
use App\Entity\Page;
use App\Entity\Slug;
use App\Entity\Template;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LarpingFixtures extends Fixture
{
	private $params;
	
	public function __construct(ParameterBagInterface $params)
	{
		$this->params = $params;
	}
	
    public function load(ObjectManager $manager)
    {
    	// Lets make sure we only run these fixtures on huwelijksplanner enviroments
    	if(!in_array("huwelijksplanner.onlie",$this->params->get('app_domains')){
    		return false;
    	}
    	
    	// Larping
    	$larping = new Organization();
    	$larping->setName('Larping.eu');
    	$larping->setDescription('Larping');
    	$larping->setRsin('');
    	$manager->persist($larping);
    	
    	// Application
    	$application= new Application();
    	$application->setName('Larping.eu');
    	$application->setDescription('orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor');
    	$application->setDomain('https://www.larping.eu');
    	$application->setOrganisation($larping);
    	$manager->persist($application);       	
    	
    	// Image
    	$image = new Image();
    	$image->setName('Larping Favicon');
    	$image->setDescription('The favicon for the larping organization');
    	$image->setBase64('AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAD///8A////AP///wD///8A////AP///wD///8A////AP///wDFxcU/CgoK/9LS0j////8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8AHh4e/5CQkH7///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AJCQkH7IyMg/////AAUFBf/a2to/////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wCMjIx+VlZWv5SUlH4GBgb/xcXFP////wD///8A////AP///wD///8A////AP///wD///8A////AICAgH5hYWG/z8/PPwUFBf9QUFC/ExMT/5CQkH7///8A////AP///wD///8A////AP///wD///8A////AP///wBBQUH/GBgY/////wAbGxv/Tk5O/x4eHv////8A////AP///wD///8A////AP///wD///8A////AP///wD///8AMDAw/xEREf////8AhISEfh4eHv8kJCT/////AP///wD///8A////AP///wD///8A////AP///wD///8A////AB8fH/8BAQH/0dHRP6ampn4BAQH/JiYm/////wD///8A////AP///wD///8A////AP///wD///8A////AP///wAODg7/AAAA/5WVlX7///8ACwsL/ycnJ/////8A////AP///wD///8A////AP///wD///8A////AP///wD///8AFBQU/xwcHP+BgYF+////ACMjI/8wMDD/////AP///wD///8A////AP///wD///8A////AP///wD///8A////ACIiIv9kZGS/HBwc/////wCDg4N+Kysr/////wD///8A////AP///wD///8A////AP///wD///8A////AP///wAZGRn/lJSUfk1NTb/T09M/FhYW/4yMjH7///8A////AP///wD///8A////AP///wD///8A////AP///wD///8AEBAQ/4WFhX6ampp+X19fv////wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AAkJCf+Tk5N+////ABoaGv/e3t4/////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wAGBgb/pqamfv///wDFxcU/Y2Njv////wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AKGhoX5paWm/0NDQP////wD///8A////AP///wD///8A/98AAP+/AAD/vwAA/r8AAPo/AADyPwAA8z8AAPM/AADzPwAA8z8AAPG/AAD1fwAA9v8AAPb/AAD3fwAA/78AAA==');
    	$image->setOrganisation($larping);
    	$manager->persist($image);
    	
    	// Style
    	$style = new Style();
    	$style->setName('Larping UI');
    	$style->setDescription('Stijldefinities voor de Larping applicatie');
    	$style->setCss('');
    	$style->setFavicon($image);
    	$style->setOrganisation($larping);
    	$manager->persist($style);            	
    	
    	// Menu
    	$menu = new Menu();
    	$menu->setName('Larping menu');
    	$menu->setDescription('');    	
    	$menu->setApplication($application);
    	$manager->persist($menu);
    	
    	// MenuItem
    	$menuItem= new MenuItem();
    	$menuItem->setName('Organisaties');
    	$menuItem->setDescription('Hier staan de organisaties die producten aanbieden op Larping.eu');
    	$menuItem->setHref('app_organization_index');
    	$menuItem->setMenu($menu);
    	$manager->persist($menuItem);      
    	
    	// MenuItem
    	$menuItem= new MenuItem();
    	$menuItem->setName('Producten');
    	$menuItem->setDescription('Hier staan de aangeboden producten');
    	$menuItem->setHref('app_product_index');
    	$menuItem->setMenu($menu);
    	$manager->persist($menuItem);      
    	
    	// Vortex Adventures
    	$va = new Organization();
    	$va->setName('Vortex Adventures');
    	$va->setDescription('Va');
    	$va->setRsin('');
    	$manager->persist($va);
    	
    }
}
