<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 19:09
 */

namespace WHMCS\Module\Addon\StaffWiki\Models;

use \WHMCS\Model\AbstractModel;
use \Illuminate\Database\Capsule\Manager;

class ArticlesModel extends AbstractModel
{
    protected $table = "mod_addon_staff_wiki_articles";
    protected $booleans = [];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [];

    public function CategoryArticles()
    {
        return $this->hasOne('WHMCS\Module\Addon\StaffWiki\Models\CategoryArticlesModel', 'article_id', 'id');
    }
    public function UserReadAllow()
    {
        return $this->hasMany('WHMCS\Module\Addon\StaffWiki\Models\UserReadModel', 'article_id', 'id');
    }

    public function getCategoryAttribute()
    {
        return $this->CategoryArticles->category;
    }

    public function getEditorIdAttribute($admin_id)
    {
        return Manager::table("tbladmins")->find($admin_id)->username;
    }

    public function getCreatorIdAttribute($admin_id)
    {
         return Manager::table("tbladmins")->find($admin_id)->username;
    }

 }