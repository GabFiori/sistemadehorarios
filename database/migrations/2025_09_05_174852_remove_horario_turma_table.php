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

        Schema::table('turmas', function (Blueprint $table) {
            $table->dropColumn([
                'segunda_1',
                'segunda_2',
                'terca_1',
                'terca_2',
                'quarta_1',
                'quarta_2',
                'quinta_1',
                'quinta_2',
                'sexta_1',
                'sexta_2',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
