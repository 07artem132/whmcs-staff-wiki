<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 19:09
 */

namespace WHMCS\Module\Addon\StaffWiki\Models;


class CategoriesModel extends \WHMCS\Model\AbstractModel
{
    protected $table = "mod_addon_staff_wiki_categories";
    protected $booleans = [];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [];

    public function articles()
    {
        return $this->belongsToMany('WHMCS\Module\Addon\StaffWiki\Models\ArticlesModel')
            ->using('WHMCS\Module\Addon\StaffWiki\Models\CategoryArticlesModel');
    }
}