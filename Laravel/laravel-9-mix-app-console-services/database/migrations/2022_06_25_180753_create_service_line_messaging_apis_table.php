<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_line_messaging_apis', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->string("bot_basic_id");
            $table->string("channel_id");
            $table->string("channel_secret");
            $table->string("channel_access_token");
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
        Schema::dropIfExists('service_line_messaging_apis');
    }
};
