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
        
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('description', 255)->nullable()->default('');
            $table->string('address', 255)->nullable()->default('');
            $table->string('email', 128)->nullable()->default();
            $table->string('phone', 32)->nullable()->default();
            $table->string('web', 32)->nullable()->default();
            $table->string('logo', 255)->nullable()->default();
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
        Schema::dropIfExists('company');
    }
};
