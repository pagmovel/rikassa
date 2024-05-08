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
        Schema::create('inscricao', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('whatsapp');
            $table->date('nascimento');
            $table->double('altura',10,2);
            $table->string('cidade');
            $table->string('estado');
            $table->string('foto');
            $table->string('profissao');
            $table->string('idiomas');
            $table->string('nacionalidade');
            $table->string('interesses_pessoais');
            $table->string('experiencia_previa');

            $table->text('instagram')->nullable();
            $table->text('facebook')->nullable();
            $table->text('x_twitter')->nullable();
            
            $table->boolean('concordo')->default(False);
            $table->timestamp('confirmou_email')->nullable();

            $table->boolean('pagou')->nullable()->default(False);
            $table->timestamp('data_pagamento')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricao');
    }
};