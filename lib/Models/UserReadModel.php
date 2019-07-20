<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 19:09
 */

namespace WHMCS\Module\Addon\StaffWiki\Models;

use \WHMCS\Model\AbstractModel;

class UserReadModel extends AbstractModel
{
    protected $table = "mod_addon_staff_wiki_user_read_articles";
    protected $booleans = [];
    protected $fillable = [];

}