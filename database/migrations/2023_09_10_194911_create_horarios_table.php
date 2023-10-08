<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('dia_mes')->nullable();
            $table->boolean('dia_mes_mostrar')->default(false);
            $table->string('dia_semana')->nullable();
            $table->string('aberto')->nullable();
            $table->string('hora_abre')->nullable();
            $table->string('hora_fecha')->nullable();
            $table->string('aviso')->nullable();
            $table->string('atendimento_fisico')->nullable();
            $table->string('atendimento_encomendas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario');
    }
}
