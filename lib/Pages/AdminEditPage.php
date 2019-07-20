<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 14.07.19 16:20
 *
 */

namespace WHMCS\Module\Addon\StaffWiki\Pages;

use AnonymousPayment\Traits\isRequestMethod;
use Illuminate\Database\Capsule\Manager;
use WHMCS\Module\Addon\StaffWiki\Interfaces\PageInterface;
use WHMCS\Module\Addon\StaffWiki\Models\ArticlesModel;
use WHMCS\Module\Addon\StaffWiki\Models\CategoriesModel;
use WHMCS\Module\Addon\StaffWiki\Models\UserReadModel;

class AdminEditPage implements PageInterface
{
    private $templateName = 'admin_edit.tpl';
    private $vars = [];

    function __construct()
    {
        $this->vars['admins'] = Manager::table("tbladmins")->where('disabled', '=', '0')->get();
        $this->vars['categories'] = CategoriesModel::all();


        $this->vars['article'] = ArticlesModel::find($_GET['id']);
        $this->vars['admins_allow'] = UserReadModel::where('article_id','=',$_GET['id'])->get()->keyBy('admin_id')->toArray();
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