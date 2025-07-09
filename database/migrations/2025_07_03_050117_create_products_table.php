<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel (table).
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('admin_id')->constrained('users');
            $table->string('description');
            $table->decimal('price', 12, 2);
            $table->string('photo_url');
            $table->timestamp('display_start')->nullable();
            $table->timestamp('display_end')->nullable();
            $table->string('status');
            $table->integer('stock');
            $table->timestamps();

            $table->index('name');
        });
    }

    /**
     * Membatalkan migrasi (menghapus tabel).
     *
     * @return void
     */
    public function down()
    {
        // Menghapus tabel jika migrasi dibatalkan
        Schema::dropIfExists('products');
    }
}
