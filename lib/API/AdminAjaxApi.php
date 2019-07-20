<?php

/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 21.04.2019
 * Time: 16:41
 */

namespace WHMCS\Module\Addon\StaffWiki\API;

use WHMCS\Module\Addon\StaffWiki\Configs\ModuleConfig;
use WHMCS\Module\Addon\StaffWiki\Models\ArticlesModel;
use WHMCS\Module\Addon\StaffWiki\Models\CategoriesModel;
use WHMCS\Module\Addon\StaffWiki\Models\CategoryArticlesModel;
use WHMCS\Module\Addon\StaffWiki\Models\UserEditModel;
use WHMCS\Module\Addon\StaffWiki\Models\UserReadModel;
use WHMCS\Module\Addon\StaffWiki\Traits\IsRequestMethodTraits;

class AdminAjaxApi
{
    use IsRequestMethodTraits;

    function boot()
    {
        global $customadminpath;

        if (!$this->isRequestMethod('POST')) {
            return;
        }
        switch (true) {
            case array_key_exists('id', $_POST) && array_key_exists('delete', $_POST):
                //ArticlesModel::find($_POST['id']);
                //todo проверка на пустую категорию, если категория пуста удаляется сама категория
                //todo Удалить связь с категорией
                //todo Удалить связь с пользователями на чтение
                ArticlesModel::destroy($_POST['id']);
                $this->response('success', 'Изменения сохранены');
                break;
            case array_key_exists('action', $_GET) && $_GET['action'] === 'add':
                $ArticlesModel = new ArticlesModel();
                $ArticlesModel->title = $_POST['title'];
                $ArticlesModel->text = rawurldecode($_POST['article']);
                $ArticlesModel->editor_id = $_SESSION['adminid'];
                $ArticlesModel->creator_id = $_SESSION['adminid'];
                $ArticlesModel->save();

                $CategoriesModel = CategoriesModel::where('title', '=', $_POST['category'])->first();

                if (empty($CategoriesModel)) {
                    $CategoriesModel = new CategoriesModel();
                    $CategoriesModel->title = $_POST['category'];
                    $CategoriesModel->description = $_POST['desk'];
                    $CategoriesModel->save();
                } else {
                    if ($CategoriesModel->description != $_POST['desk']) {
                        $CategoriesModel->description = $_POST['desk'];
                        $CategoriesModel->save();
                    }
                }

                $CategoryArticlesModel = new CategoryArticlesModel();
                $CategoryArticlesModel->category_id = $CategoriesModel->id;
                $CategoryArticlesModel->article_id = $ArticlesModel->id;
                $CategoryArticlesModel->save();

                foreach ($_POST['articlesFilter'] as $item) {
                    $UserReadModel = new  UserReadModel();
                    $UserReadModel->admin_id = $item;
                    $UserReadModel->article_id = $ArticlesModel->id;
                    $UserReadModel->save();
                }
                header("Location: /$customadminpath/addonmodules.php?module=" . ModuleConfig::getModuleName());
                break;
            case array_key_exists('action', $_GET) && $_GET['action'] === 'edit':
                $ArticlesModel = ArticlesModel::find($_POST['id']);
                $ArticlesModel->title = $_POST['title'];
                $ArticlesModel->text = rawurldecode($_POST['article']);
                $ArticlesModel->editor_id = $_SESSION['adminid'];
                $ArticlesModel->save();

                $CategoriesModel = CategoriesModel::where('title', '=', $_POST['category'])->first();

                if (empty($CategoriesModel)) {
                    $CategoriesModel = new CategoriesModel();
                    $CategoriesModel->title = $_POST['category'];
                    $CategoriesModel->description = $_POST['desk'];
                    $CategoriesModel->save();
                } else {
                    if ($CategoriesModel->description != $_POST['desk']) {
                        $CategoriesModel->description = $_POST['desk'];
                        $CategoriesModel->save();
                    }
                }
                $CategoryArticlesModel = CategoryArticlesModel::where('article_id', '=', $_POST['id'])->first();
                if ($CategoryArticlesModel->category_id != $CategoriesModel->id) {
                    $count = CategoryArticlesModel::where('category_id', '=', $CategoryArticlesModel->category_id)->count();
                    if ($count == 1) {
                        CategoriesModel::where('id', '=', $CategoryArticlesModel->category_id)->delete();
                    }
                    $CategoryArticlesModel->delete();
                    $CategoryArticlesModel = new CategoryArticlesModel();
                    $CategoryArticlesModel->category_id = $CategoriesModel->id;
                    $CategoryArticlesModel->article_id = $ArticlesModel->id;
                    $CategoryArticlesModel->save();

                }
                UserReadModel::where('article_id', '=', $_POST['id'])->delete();
                foreach ($_POST['articlesFilter'] as $item) {
                    $UserReadModel = new  UserReadModel();
                    $UserReadModel->admin_id = $item;
                    $UserReadModel->article_id = $ArticlesModel->id;
                    $UserReadModel->save();
                }
                header("Location: /$customadminpath/addonmodules.php?module=" . ModuleConfig::getModuleName());
                break;
            case array_key_exists('id', $_POST) && array_key_exists('status', $_POST):
                if ($_POST['status'] == 'true') {
                    $userEdit = new UserEditModel();
                    $userEdit->admin_id = $_POST['id'];
                    $userEdit->save();
                } else {
                    UserEditModel::where('admin_id','=',$_POST['id'])->delete();
                }

                $this->response('success', 'Изменения сохранены');
                break;
            default:
                $this->response('error', 'Неизвестное действие');
                break;
        }
    }

    function response($status, $message = null)
    {
        echo json_encode([
            'status' => $status,
            'message' => $message
        ]);
        die();
    }
}