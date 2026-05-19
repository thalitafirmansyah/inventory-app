<?php
// database/migrations/2024_01_01_000010_create_receipts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('no_receipt')->unique();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['in', 'out']);
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->string('tujuan')->nullable();
            $table->string('penerima')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('ttd')->nullable(); // path tanda tangan
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('receipts');
    }
};