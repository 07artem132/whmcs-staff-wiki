<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 13.07.19 4:46
 *
 */

/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 09.05.2019
 * Time: 15:52
 */

namespace WHMCS\Module\Addon\StaffWiki\Menu;

use WHMCS\Module\Addon\StaffWiki\Configs\ModuleConfig;

class AdminAreaMenu extends \WHMCS\View\Menu\MenuFactory {
	protected $rootItemName = "Domain Manager nav bar";

	public function navbar() {
		return $this->loader->load( $this->buildMenuStructure( $this->getNavBarStructure() ) );
	}

	protected function getNavBarStructure() {
		$menuItems = [
			[
				"name"       => "index",
				"label"      => 'Статьи',
				"uri"        => ModuleConfig::getModuleLink() . "&action=index",
				"order"      => 1,
				"attributes" => [
					"class" => ! array_key_exists( 'action', $_GET ) || $_GET['action'] === 'index' ? 'active' : ''
				]
			],
			[
				"name"       => "settings",
				"label"      => 'Настройки',
				"uri"        => ModuleConfig::getModuleLink() . "&action=settings",
				"order"      => 2,
				"attributes" => [
					"class" => array_key_exists( 'action', $_GET ) && $_GET['action'] === 'settings' ? 'active' : ''
				]
			],

		];

		return $menuItems;
	}

}


