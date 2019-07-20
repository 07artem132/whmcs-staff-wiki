<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 13.07.19 5:04
 *
 */

/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 09.05.2019
 * Time: 14:22
 */

namespace WHMCS\Module\Addon\StaffWiki\Interfaces;

interface  PageInterface {
	/**
	 * @return string
	 */
	public function getTemplateName();

	/**
	 * @return array
	 */
	public function getVars();

	public function getSubMenu();
}