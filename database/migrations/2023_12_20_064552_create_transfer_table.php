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
        Schema::create('transfer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nereden_id');
            $table->unsignedBigInteger('nereye_id');
            $table->float('fiyat');
            $table->unsignedBigInteger('arac_turu_id');
            $table->timestamps();

            $table->foreign('nereden_id')->references('id')->on('konum')->onDelete('cascade');
            $table->foreign('nereye_id')->references('id')->on('konum')->onDelete('cascade');
            $table->foreign('arac_turu_id')->references('id')->on('arac_turu')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer');
    }
};
