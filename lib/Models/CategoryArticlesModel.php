<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 19:09
 */

namespace WHMCS\Module\Addon\StaffWiki\Models;


class CategoryArticlesModel extends \WHMCS\Model\AbstractModel
{
    protected $table = "mod_addon_staff_wiki_category_articles";
    protected $booleans = [];
    protected $fillable = [];
    protected $primaryKey = 'article_id';

    public function category()
    {
        return $this->hasOne('WHMCS\Module\Addon\StaffWiki\Models\CategoriesModel', 'id', 'category_id');
    }

}