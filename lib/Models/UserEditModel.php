<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 20.04.2019
 * Time: 19:09
 */

namespace WHMCS\Module\Addon\StaffWiki\Models;

use \WHMCS\Model\AbstractModel;

class UserEditModel extends AbstractModel
{
    protected $table = "mod_addon_staff_wiki_user_edit";
    protected $booleans = [];
    protected $fillable = [];

}