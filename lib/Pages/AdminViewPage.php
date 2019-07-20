<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 09.05.2019
 * Time: 16:32
 */

namespace WHMCS\Module\Addon\StaffWiki\Pages;

use WHMCS\Module\Addon\StaffWiki\Interfaces\PageInterface;
use WHMCS\Module\Addon\StaffWiki\Models\ArticlesModel;
use WHMCS\Module\Addon\StaffWiki\Models\CategoriesModel;
use WHMCS\Module\Addon\StaffWiki\Models\UserEditModel;

class AdminViewPage implements PageInterface
{
    private $templateName = 'admin_view.tpl';
    private $vars = [];

    function __construct()
    {
        $id = $_GET['id'];
        $this->vars['article'] = ArticlesModel::with('CategoryArticles.category')->where('id', '=', $id)->first();
        $this->vars['categories'] = CategoriesModel::all();
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