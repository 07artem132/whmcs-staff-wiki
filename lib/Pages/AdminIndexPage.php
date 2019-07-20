<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 13.07.19 5:02
 *
 */

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

class AdminIndexPage implements PageInterface
{
    private $templateName = 'admin_index.tpl';
    private $vars = [];

    function __construct()
    {
        $articles = ArticlesModel::with(['CategoryArticles.category', 'UserReadAllow'])->get();
        foreach ($articles as $key => $article) {
            if ($article->UserReadAllow->isempty()) {
                $this->vars['articles'][$key] = $article;
                continue;
            }
            $array = $article->UserReadAllow->keyBy('admin_id')->toArray();
            if (!array_key_exists($_SESSION['adminid'], $array)) {
                continue;
            }
            $this->vars['articles'][$key] = $article;
        }

        $this->vars['categories'] = CategoriesModel::all();
        $this->vars['creators'] = $articles->pluck('creator_id')->unique();


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