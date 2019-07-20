<?php
/**
 *  Created by PhpStorm.
 *  User: Артём
 *  Date time: 11.07.19 23:06
 *
 */

use WHMCS\Module\Addon\StaffWiki\Configs\ModuleConfig;

add_hook('AdminAreaHeaderOutput', 1, function ($vars) {
    global $customadminpath;

    $url = '/' . $customadminpath . '/addonmodules.php?module=StaffWiki';

    $script = '<script>';
    $script .= '$(function() {';
    $script .= '$(".topbar > div > #logout").before(\'<a href="' . $url . '">База знаний</a> | \');';
    $script .= '});';
    $script .= '</script>';

    return $script;
});

add_hook('AdminAreaHeaderOutput', 99999999, function ($vars) {
    try {
        if (!isset($_GET['module']) || $_GET['module'] != ModuleConfig::getModuleName()) {
            return null;
        }
        $str = '';
        foreach (scandir(ModuleConfig::getWhmcsRootDir() . '/modules/addons/' . ModuleConfig::getModuleName() . '/templates/css/admin') as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            $str .= '<link rel="stylesheet" type="text/css" href="/modules/addons/' . ModuleConfig::getModuleName() . '/templates/css/admin/' . $item . '?v=' . time() . '">';
        }
    } catch (Exception $e) {
        logActivity(ModuleConfig::getModuleName() . ' [AdminAreaHeadOutput]:' . $e->getMessage(), 0);
    }
    return $str;
});