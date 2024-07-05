<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['coordinates']);
            $table->string('latitude');
            $table->string('longitude');
            $table->string('street');
            $table->string('city');
            $table->string('postcode');
            $table->string('opening_time')->change();
            $table->string('closing_time')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'address', 'city', 'postcode']);
            $table->string('coordinates');
            $table->integer('opening_time')->change();
            $table->integer('closing_time')->change();
        });
    }
};
