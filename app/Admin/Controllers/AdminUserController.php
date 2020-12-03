<?php
/**
 * Created by PhpStorm.
 * User: leaf
 * Date: 2020/12/2
 * Time: 6:01 PM
 */

namespace App\Admin\Controllers;


use Encore\Admin\Controllers\UserController;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;

class AdminUserController extends UserController
{
    protected function grid()
    {
        $userModel = config('admin.database.users_model');

        $grid = new Grid(new $userModel());

        $grid->model()->where('id', '<>', 1);
        $grid->column('id', 'ID')->sortable();
        $grid->column('username', trans('admin.username'));
        $grid->column('name', trans('admin.name'));
        $grid->column('roles', trans('admin.roles'))->pluck('name')->label();
        $grid->column('created_at', trans('admin.created_at'));
        $grid->column('updated_at', trans('admin.updated_at'));

        $grid->actions(function (Actions $actions) {
            if ($actions->getKey() == 1) {
                $actions->disableDelete();
            }
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });

        return $grid;
    }
}