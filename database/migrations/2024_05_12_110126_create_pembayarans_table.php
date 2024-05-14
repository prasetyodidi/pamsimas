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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('total');
            $table->string('status');
            $table->string('payment_type')->nullable();
            $table->dateTime('transaction_time')->nullable();
            $table->string('snap_url');
            $table->timestamps();

            $table->foreign('id_pelanggan')->on('pelanggans')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
