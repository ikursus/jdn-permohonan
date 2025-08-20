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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Syarat nak guna ni, kena ikut naming convension singular dan plural
            $table->string('jenis_permohonan', 100);
            $table->string('wilayah_asal');
            $table->string('wilayah_ibu_negara');
            $table->date('tarikh_lapor_diri')->nullable();
            $table->date('tarikh_terakhir_kemudahan')->nullable();
            $table->date('tarikh_kemudahan_diperlukan')->nullable();
            $table->text('pengakuan')->nullable();
            $table->date('pengakuan_tarikh')->nullable();
            $table->string('status', 100)->default('deraf');
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
