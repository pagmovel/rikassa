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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inscricao_id');
            $table->bigInteger('collection_id')->nullable();
            $table->string('collection_status')->nullable();
            $table->bigInteger('payment_id')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('external_reference')->nullable();
            $table->string('payment_type')->nullable();
            $table->bigInteger('merchant_order_id')->nullable();
            $table->string('preference_id')->nullable();
            $table->string('site_id')->nullable();
            $table->string('processing_mode')->nullable();
            $table->bigInteger('merchant_account_id')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
