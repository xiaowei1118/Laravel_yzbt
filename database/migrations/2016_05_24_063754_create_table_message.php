<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_message', function (Blueprint $table) {
            $table->increments('message_id');
            $table->string("title")->comment('标题');
            $table->text('content')->comment('内容');
            $table->timestamps();
            $table->string('link')->nullable()->comment("连接");
            $table->string('category')->comment("分类");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tb_message');
    }
}
