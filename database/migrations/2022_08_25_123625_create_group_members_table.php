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
        Schema::create('group_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_online')->default(0);
            $table->foreignId('contact_id')->nullable()->unique()->constrained();
            $table->timestamp('last_status_at')->nullable();
            // $table->timestamp('joined_datetime')->nullable();
            // $table->timestamp('left_datetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_members');
    }
};
