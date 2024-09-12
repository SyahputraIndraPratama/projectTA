<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id('id_kecamatan', 40);
            $table->unsignedBigInteger('id_kabupaten');
            $table->string('kecamatan', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kecamatan');
    }
};
