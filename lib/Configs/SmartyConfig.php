<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 13.07.19 4:37
 *
 */

/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 24.12.2017
 * Time: 15:02
 */

namespace WHMCS\Module\Addon\StaffWiki\Configs;


class SmartyConfig {

	public static function GetTemplateDir() {
		return ModuleConfig::getWhmcsRootDir() . '/modules/addons/' . ModuleConfig::getModuleName() . '/templates/';
	}

	public static function GetCompileDir() {
		global $templates_compiledir;

		return $templates_compiledir;
	}
}