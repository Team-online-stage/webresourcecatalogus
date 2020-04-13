<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use App\Entity\Organization;
use App\Entity\Style;
use App\Entity\Application;
use App\Entity\Page;
use App\Entity\Slug;
use App\Entity\Template;
use App\Entity\Image;

class ComponentFixtures extends Fixture
{
	private $params;

	public function __construct(ParameterBagInterface $params)
	{
		$this->params = $params;
	}

    public function load(ObjectManager $manager)
    {

    }
}
