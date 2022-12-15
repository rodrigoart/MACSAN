<?php use Illuminate\Database\Migrations\Migration;
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
        Schema::create('hoja_monitoreos', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->boolean('aprovado')->default(false);
            $table->unsignedBigInteger('aprovado_por')->nullable();
            $table->unsignedBigInteger('insumos_actualizado_por')->nullable();
            $table->date('ultima_actualizacion_insumos')->nullable();
            $table->date('fecha')->nullable();
            $table->string('municipio')->nullable();
            $table->string('territorio')->nullable();
            $table->string('cs')->nullable();
            $table->string('ps')->nullable();
            $table->string('personal_supervisado')->nullable();
            $table->string('cargo')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();

            //relations
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('actualizado_por')->references('id')->on('users')->onDelete('set null');
            $table->foreign('aprovado_por')->references('id')->on('users')->onDelete('set null');
            $table->foreign('insumos_actualizado_por')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoja_monitoreos');
    }
};
