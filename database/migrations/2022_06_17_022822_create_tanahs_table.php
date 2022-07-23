<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanahs', function (Blueprint $table) {
            $table->id();
            $table->json('pemilik')->nullable();
            $table->string('letak')->nullable();
            $table->json('ukuran')->nullable();
            $table->json('batas')->nullable();
            $table->string('peruntukan')->nullable();
            $table->text('riwayat_tanah')->nullable();
            $table->json('coordinates');
            $table->json('registration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanahs');
    }
};
