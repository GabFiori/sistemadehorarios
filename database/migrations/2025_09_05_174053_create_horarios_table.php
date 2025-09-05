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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
            $table->foreignId('campo_horario_id')->constrained('campo_horarios')->onDelete('cascade');
            $table->foreignId('uc_id')->nullable()->constrained('ucs')->onDelete('set null');
            $table->foreignId('professor_id')->nullable()->constrained('professores')->onDelete('set null');
            $table->foreignId('sala_id')->nullable()->constrained('salas')->onDelete('set null');
            $table->timestamps();
            $table->unique(['turma_id', 'campo_horario_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
