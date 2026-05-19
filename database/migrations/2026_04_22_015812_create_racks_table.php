// database/migrations/2024_01_01_000003_create_racks_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('racks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rak')->unique();
            $table->string('nama_rak');
            $table->string('lokasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('racks');
    }
};