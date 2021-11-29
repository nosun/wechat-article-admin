<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('wechat-article-tasks', WechatArticleTaskController::class);
    $router->resource('wechat-account-tasks', WechatAccountTaskController::class);
    $router->resource('wechat-accounts', WechatAccountController::class);
    $router->resource('wechat-article-list', WechatArticleListController::class);
    $router->resource('wechat-articles', WechatArticleController::class);
    $router->resource('wechat-article-comments', WechatArticleCommentController::class);
    $router->resource('wechat-article-dynamics', WechatArticleDynamicController::class);
});
