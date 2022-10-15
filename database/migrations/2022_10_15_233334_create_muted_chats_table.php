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
        Schema::create('muted_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained();

            $table->integer('for')->unsigned();
            $table->foreign('for')->refrences('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('muted_chats');
    }
};
