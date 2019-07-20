<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 11.07.19 23:05
 *
 */

use WHMCS\Module\Addon\StaffWiki\API\AdminAjaxApi;
use WHMCS\Module\Addon\StaffWiki\Controllers\PageController;
use WHMCS\Module\Addon\StaffWiki\Controllers\InstallController;
use WHMCS\Module\Addon\StaffWiki\Controllers\UninstallController;
use WHMCS\Module\Addon\StaffWiki\Menu\AdminAreaMenu;
use WHMCS\Module\Addon\StaffWiki\Configs\ModuleConfig;
use WHMCS\Module\Addon\Setting;

function StaffWiki_config()
{
    $configarray = [
        "name" => "Вики для сотрудников",
        "description" => "",
        "version" => "1",
        "author" => "service-voice",
        "fields" => [
            "DeleteTableWhenDisabled" => [
                "FriendlyName" => "Удалять данные модуля при отключении ?",
                "Type"         => "yesno",
                "Description"  => " Отметьте здесь дабы удалить данные модуля при отключении оного.",
            ]
        ]
    ];

    return $configarray;
}

function StaffWiki_output($vars)
{
    $AdminAjaxApi = new AdminAjaxApi();
    $AdminAjaxApi->boot();

    $PageController = new PageController($vars);
    $PageController->setDefaultAction('index');
    $PageController->setSuffixTemplate('admin');

    $PageController->setMenuTemplate('include\navbar.tpl');
    $PageController->setMenu((new AdminAreaMenu())->navbar());
    $PageController->run();
}


function StaffWiki_activate()
{

    if (!empty($error = InstallController::createTableArticles())) {
        return $error;
    }

    if (!empty($error = InstallController::createTableCategories())) {
        return $error;
    }
    if (!empty($error = InstallController::createTableCategoryArticles())) {
        return $error;
    }
    if (!empty($error = InstallController::createTableUserReadArticles())) {
        return $error;
    }
    if (!empty($error = InstallController::createTableUserEdit())) {
        return $error;
    }

    return array(
        'status' => 'success',
        'description' => 'Модуль успешно активирован',
    );
}

function StaffWiki_deactivate()
{
    if (!empty($dropTable = Setting::Module(ModuleConfig::getModuleName())->where('setting', '=', 'DeleteTableWhenDisabled')->first())) {
     if ($dropTable->value === 'on') {
            if (!empty($error = UninstallController::dropTable('mod_addon_staff_wiki_articles'))) {
                return $error;
            }
            if (!empty($error = UninstallController::dropTable('mod_addon_staff_wiki_categories'))) {
                return $error;
            }
            if (!empty($error = UninstallController::dropTable('mod_addon_staff_wiki_category_articles'))) {
                return $error;
            }
            if (!empty($error = UninstallController::dropTable('mod_addon_staff_wiki_user_read_articles'))) {
                return $error;
            }
            if (!empty($error = UninstallController::dropTable('mod_addon_staff_wiki_user_edit'))) {
                return $error;
            }
        }
    }

    return array(
        'status' => 'success',
        'description' => 'Модуль успешно деактивирован',
    );
}
