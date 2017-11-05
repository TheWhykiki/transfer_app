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
				'attributes' => [
					'class' => 'mainMenuLink',
					'id' => 'mainMenuID'
				]
			],
			[
				'routename' => 'Login',
				'route' => 'user_login',
				'attributes' => [
					'class' => 'mainMenuLink',
					'id' => 'mainMenuID'
				]
			],
			[
				'routename' => 'Neue Fahrt anlegen',
				'route' => 'neue_fahrt',
				'attributes' => [
					'class' => 'mainMenuLink',
					'id' => 'mainMenuID'
				]
			],
			[
				'routename' => 'Fahrten anzeigen',
				'route' => 'alle_fahrten_uncached',
				'attributes' => [
					'class' => 'mainMenuLink',
					'id' => 'mainMenuID'
				]
			],
		];
		//dump($testMenus);die;

		foreach($menuItems as $menuItem){
			$routename = $menuItem['routename'];
			$attributes = $menuItem['attributes'];
			$route = $menuItem['route'];
			$menu->addChild($routename, ['route' => $route, 'attributes' => $attributes]);
		}

		$menu['Fahrten anzeigen']
			->addChild('Profile', array(
				'uri' => '#'
			))
			->setAttribute('divider_append', true);

		return $menu;
	}
}