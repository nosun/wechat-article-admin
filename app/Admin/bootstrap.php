<?php

use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use App\Admin\Extensions\Nav;

Grid::init(function (Grid $grid) {
    $grid->disableExport();
    $grid->disableColumnSelector();
    $grid->disableBatchActions();
    $grid->actions(function (Grid\Displayers\Actions $actions) {
        $actions->disableView();
    });
});

Form::init(function (Form $form) {
    $form->disableViewCheck();
    $form->disableEditingCheck();
    $form->disableCreatingCheck();
    $form->tools(function ($form) {
        $form->disableView();
    });
});

Encore\Admin\Form::forget(['map']);
Encore\Admin\Form::extend('thumb', \App\Admin\Extensions\Form\ThumbField::class);
Encore\Admin\Show::extend('html', \App\Admin\Extensions\Show\HtmlShow::class);
Encore\Admin\Show::extend('thumb', \App\Admin\Extensions\Show\ThumbShow::class);

app('view')->prependNamespace('admin', resource_path('views/admin'));

Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {

//    $navbar->left(new Nav\DropDown());
//
    $navbar->right(new Nav\Links());
});
