// database/migrations/2024_01_01_000006_create_stock_mutations_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_mutations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['in', 'out']);
            $table->integer('jumlah');
            $table->integer('stok_sebelum');
            $table->integer('stok_sesudah');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['product_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
            $table->index('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_mutations');
    }
};