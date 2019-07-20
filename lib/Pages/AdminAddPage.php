<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 14.07.19 14:09
 *
 */

/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 13.07.19 5:02
 *
 */

namespace WHMCS\Module\Addon\StaffWiki\Pages;

use AnonymousPayment\Traits\isRequestMethod;
use Illuminate\Database\Capsule\Manager;
use WHMCS\Module\Addon\StaffWiki\Interfaces\PageInterface;
use WHMCS\Module\Addon\StaffWiki\Models\ArticlesModel;
use WHMCS\Module\Addon\StaffWiki\Models\CategoriesModel;

class AdminAddPage implements PageInterface
{
    private $templateName = 'admin_add.tpl';
    private $vars = [];

    function __construct()
    {
        $this->vars['admins'] = Manager::table("tbladmins")->where('disabled', '=', '0')->get();
        $this->vars['categories'] = CategoriesModel::all();
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