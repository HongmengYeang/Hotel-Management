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
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn("check_in_date");
            $table->dropColumn("check_out_date");
            $table->dropColumn("booking_date");
            $table->dropColumn("price");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dateTime("check_in_date")->nullable();
            $table->dateTime("check_out_date")->nullable();
            $table->dateTime("booking_date")->nullable();
            $table->decimal("price", 10, 2)->nullable();
        });
    }
};
