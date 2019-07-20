<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 13.07.19 5:01
 *
 */

/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 09.05.2019
 * Time: 16:32
 */

namespace WHMCS\Module\Addon\StaffWiki\Pages;

use Illuminate\Database\Capsule\Manager;
use WHMCS\Module\Addon\StaffWiki\Interfaces\PageInterface;
use WHMCS\Module\Addon\StaffWiki\Models\UserEditModel;

class AdminSettingsPage implements PageInterface
{
    private $templateName = 'admin_settings.tpl';
    private $vars = [];

    function __construct()
    {
        $this->vars['admins'] = Manager::table("tbladmins")->where('disabled', '=', '0')->get();
        $this->vars['admins_activated'] = UserEditModel::all()->keyBy('admin_id')->toArray();

        $admins_activated = UserEditModel::all()->keyBy('admin_id')->toArray();
        if (count($admins_activated) == 0 || array_key_exists($_SESSION['adminid'], $admins_activated)) {
            $this->vars['allow_edit'] = true;
        } else {
            $this->vars['allow_edit'] = false;
        }

    }

    function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * @return array
     */
    function getVars()
    {
        return $this->vars;
    }

    function getSubMenu()
    {
        return null;
    }

}