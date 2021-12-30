<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsingSiteNameToWechatArticleListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wechat_article_list', function (Blueprint $table) {
            $table->string('using_site_name',50)->after('format_status')->nullable();
            $table->index('using_site_name');
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
            $table->dropColumn('using_site_name');
        });
    }
}
