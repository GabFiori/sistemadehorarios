<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('turmas', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('representante');

        $table->string('segunda_1');
        $table->string('segunda_2');
        $table->string('terca_1');
        $table->string('terca_2');
        $table->string('quarta_1');
        $table->string('quarta_2');
        $table->string('quinta_1');
        $table->string('quinta_2');
        $table->string('sexta_1');
        $table->string('sexta_2');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
