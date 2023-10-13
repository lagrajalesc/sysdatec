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
        Schema::create('profesores_por_materia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_profesor')->unsigned()->nullable(false);
            $table->foreign('id_profesor')->references('id')->on('profesor');
            $table->integer('id_materia')->unsigned()->nullable(false);
            $table->foreign('id_materia')->references('id')->on('materia');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores_por_materia');
    }
};
