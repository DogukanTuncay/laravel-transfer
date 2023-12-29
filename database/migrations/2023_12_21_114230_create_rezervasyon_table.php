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
        Schema::create('rezervasyon', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nereden_id');
            $table->bigInteger('nereye_id');
            $table->smallInteger('yetiskin');
            $table->smallInteger('cocuk');
            $table->string('date');
            $table->string('hour');
            $table->string('parabirimi');
            $table->float('fiyat');
            $table->bigInteger('arac_turu_id');
            $table->string('isim');
            $table->string('soyisim');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rezervasyon');
    }
};
