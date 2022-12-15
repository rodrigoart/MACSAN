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
        Schema::create('problemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('minuta_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('responsable')->nullable();
            $table->string('causas')->nullable();
            $table->string('acciones')->nullable();
            $table->text('recursos')->nullable();
            $table->date('fecha_aplicacion')->nullable();
            $table->date('fecha_solucionado')->nullable();
            $table->text('logros')->nullable();
            $table->boolean('solucionado')->default(false);
            $table->timestamps();

            $table->foreign('minuta_id')->references('id')->on('minutas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problemas');
    }
};
