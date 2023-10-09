<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_webs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('index');
            $table->string('keyword')->comment('tags,content');
            $table->text('content');
            $table->text('desc')->nullable();
            $table->string('image')->comment('image:og; logo')->nullable();
            $table->tinyInteger('status')->comment('1: hiển thị; 2: ẩn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_webs');
    }
}
