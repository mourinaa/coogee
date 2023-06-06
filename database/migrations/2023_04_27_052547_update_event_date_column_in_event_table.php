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
        // Schema::rename('event_date', 'Event_Date');
        Schema::table('event', function (Blueprint $table) {
            //
            // $table->renameColumn('event_date', 'epen_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('events', function (Blueprint $table) {
        //     // $table->renameColumn('Event_Date', 'event_date');
        // });
    }
};
