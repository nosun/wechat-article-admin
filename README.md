## 项目说明

项目基于 laravel 及 laravel-admin 进行开发，为 wechat-spider 项目的管理后台，方便查看检索爬取的任务及管理文章数据。

## 项目运行要求

1. php8.0-fpm 及基础扩展
2. redis
3. mysql

## 项目安装流程

1. 进入项目的存放目录，克隆本项目: ```git clone https://github.com/nosun/wechat-article-admin```。
2. 进入项目目录，运行 ```composer install``` ，安装项目依赖的包。
3. 位于项目目录，运行 ```cp .env .env.example && php artisan key:generate ```, 创建 .env 文件，并创建项目加密密钥。
4. 修改 .env 中的数据库连接信息，redis 连接信息。 
5. 运行 ```php artisan migrate```，更新数据库结构。
6. 运行 ```php artisan db:seed ```, 安装后台基础菜单。
7. 运行 ```php artisan admin:create-user ```, 根据命令行提示，创建后台用户。
8. 运行 ```php artisan serve```, 项目启动。
9. 访问 ```127.0.0.1:8000/admin```,即可进入管理后台。

## 正式部署

正式部署流程和项目安装流程一致，主要的区别在于 nginx/apache 配置以及域名解析。
