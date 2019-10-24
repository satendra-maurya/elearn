<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTokensTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tokens', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('user_id')->unsigned()->index('user_id');
            $table->boolean('device_type')->comment('1-ios 2-android');
            $table->string('token', 191)->nullable();
            $table->string('device_token', 200)->nullable();
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
        Schema::drop('user_tokens');
    }

}
