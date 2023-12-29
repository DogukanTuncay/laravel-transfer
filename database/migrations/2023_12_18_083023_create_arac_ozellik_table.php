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
        Schema::create('arac_ozellik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('arac_id');
            $table->string('ozellik');
            $table->timestamps();
        });
        Schema::table('arac_ozellik', function (Blueprint $table) {
            $table->foreign('arac_id')
                  ->references('id')
                  ->on('arac_turu')
                  ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arac_ozellik');
    }
};
