<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    const CREATED_AT = 'sent_datetime';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->mediumText('text');
            $table->foreignId('conversation_id')->nullable()->constrained();
            $table->foreignId('contact_id')->nullable()->constrained();
            $table->timestamp('sent_datetime')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
