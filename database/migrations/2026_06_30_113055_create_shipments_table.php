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
    Schema::create('shipments', function (Blueprint $table) {

        $table->id();

        $table->string('kode_pengiriman');

        $table->string('negara_asal');

        $table->string('negara_tujuan');

        $table->string('pelabuhan_asal');

        $table->string('pelabuhan_tujuan');

        $table->date('tanggal_berangkat');

        $table->date('estimasi_tiba');

        $table->string('status');

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
