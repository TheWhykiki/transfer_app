<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 01.11.2017
 * Time: 18:22
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class MenuBuilder implements ContainerAwareInterface
{
	use ContainerAwareTrait;

	public function mainMenu(FactoryInterface $factory, array $options)
	{
		$menu = $factory->createItem('root');

		$menuItems = [
			[
				'routename' => 'Startseite',
				'route' => 'homepage',
			],
			[
				'routename' => 'Neue Fahrt anlegen',
				'route' => 'neue_fahrt',
			],
			[
				'routename' => 'Fahrten anzeigen',
				'route' => 'alle_fahrten_uncached',
			],
		];
		//dump($testMenus);die;

		foreach($menuItems as $menuItem){
			$routename = $menuItem['routename'];
			$route = $menuItem['route'];
			$menu->addChild($routename, array('route' => $route));
		}

		return $menu;
	}
}