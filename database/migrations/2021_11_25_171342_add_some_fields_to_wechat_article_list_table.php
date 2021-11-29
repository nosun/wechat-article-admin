<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToWechatArticleListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wechat_article_list', function (Blueprint $table) {
            $table->tinyInteger('status')->after('title')->default(0);

            $table->integer('read_num')->default(0)->nullable();
            $table->integer('like_num')->default(0)->nullable();
            $table->integer('comment_count')->default(0)->nullable();
            $table->tinyInteger('format_status')->default(0);

            $table->index('__biz');
            $table->index('title');
            $table->index('author');
            $table->index('publish_time');
            $table->index('read_num');
        });

        Schema::table('wechat_article', function (Blueprint $table) {
            $table->text('content')->nullable()->after('content_html');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wechat_article_list', function (Blueprint $table) {
            $table->dropColumn('status');

            $table->dropColumn('read_num');
            $table->dropColumn('like_num');
            $table->dropColumn('comment_count');

            $table->dropColumn('format_status');
        });

        Schema::table('wechat_article', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
}
