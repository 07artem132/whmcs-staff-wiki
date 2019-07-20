<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 24.04.2019
 * Time: 20:23
 */

namespace WHMCS\Module\Addon\StaffWiki\Controllers;

use \WHMCS\Database\Capsule;

class InstallController
{

    public static function createTableArticles()
    {
        try {
            if (!Capsule::schema()->hasTable('mod_addon_staff_wiki_articles')) {
                Capsule::schema()->create('mod_addon_staff_wiki_articles', function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->text('title');
                    $table->longText('text');
                    $table->unsignedInteger('editor_id');
                    $table->unsignedInteger('creator_id');
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            return array(
                'status' => 'error',
                'description' => 'При создании таблицы (mod_addon_staff_wiki_articles) возникла ошибка:' . $e->getMessage()
            );
        }
        return [];
    }

    public static function createTableCategories()
    {
        try {
            if (!Capsule::schema()->hasTable('mod_addon_staff_wiki_categories')) {
                Capsule::schema()->create('mod_addon_staff_wiki_categories', function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->text('title');
                    $table->text('description');
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            return array(
                'status' => 'error',
                'description' => 'При создании таблицы (mod_addon_staff_wiki_categories) возникла ошибка:' . $e->getMessage()
            );
        }
        return [];
    }

    public static function createTableCategoryArticles()
    {
        try {
            if (!Capsule::schema()->hasTable('mod_addon_staff_wiki_category_articles')) {
                Capsule::schema()->create('mod_addon_staff_wiki_category_articles', function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->unsignedInteger('category_id');
                    $table->unsignedInteger('article_id');
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            return array(
                'status' => 'error',
                'description' => 'При создании таблицы (mod_addon_staff_wiki_category_articles) возникла ошибка:' . $e->getMessage()
            );
        }
        return [];

    }

    public static function createTableUserReadArticles()
    {
        try {
            if (!Capsule::schema()->hasTable('mod_addon_staff_wiki_user_read_articles')) {
                Capsule::schema()->create('mod_addon_staff_wiki_user_read_articles', function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->unsignedInteger('admin_id');
                    $table->unsignedInteger('article_id');
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            return array(
                'status' => 'error',
                'description' => 'При создании таблицы (mod_addon_staff_wiki_user_read_articles) возникла ошибка:' . $e->getMessage()
            );
        }
        return [];

    }

    public static function createTableUserEdit()
    {
        try {
            if (!Capsule::schema()->hasTable('mod_addon_staff_wiki_user_edit')) {
                Capsule::schema()->create('mod_addon_staff_wiki_user_edit', function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->unsignedInteger('admin_id');
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            return array(
                'status' => 'error',
                'description' => 'При создании таблицы (mod_addon_staff_wiki_user_edit) возникла ошибка:' . $e->getMessage()
            );
        }
        return [];

    }
}