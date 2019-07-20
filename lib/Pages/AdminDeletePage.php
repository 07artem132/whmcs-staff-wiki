<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 14.07.19 17:12
 *
 */

namespace WHMCS\Module\Addon\StaffWiki\Pages;

use AnonymousPayment\Traits\isRequestMethod;
use Illuminate\Database\Capsule\Manager;
use WHMCS\Module\Addon\StaffWiki\Configs\ModuleConfig;
use WHMCS\Module\Addon\StaffWiki\Interfaces\PageInterface;
use WHMCS\Module\Addon\StaffWiki\Models\ArticlesModel;
use WHMCS\Module\Addon\StaffWiki\Models\CategoriesModel;
use WHMCS\Module\Addon\StaffWiki\Models\CategoryArticlesModel;
use WHMCS\Module\Addon\StaffWiki\Models\UserReadModel;

class AdminDeletePage implements PageInterface
{
    private $templateName = 'admin_add.tpl';
    private $vars = [];

    function __construct()
    {
        global $customadminpath;

        ArticlesModel::destroy($_GET['id']);
        UserReadModel::where('article_id', '=', $_GET['id'])->delete();
        $CategoryArticlesModel = CategoryArticlesModel::where('article_id', '=', $_GET['id'])->get();
        if (count($CategoryArticlesModel) == 1) {
            CategoryArticlesModel::where('article_id', '=', $_GET['id'])->delete();
            CategoriesModel::where('id', '=', $CategoryArticlesModel[0]->category_id)->delete();
        } else {
            CategoryArticlesModel::where('article_id', '=', $_GET['id'])->delete();
        }
        header("Location: /$customadminpath/addonmodules.php?module=" . ModuleConfig::getModuleName());

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