<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracaos', function (Blueprint $table) {
            $table->id();
            $table->boolean('pagina_inicial')->default(false);
            $table->string('pagina_inicial_titulo')->nullable();
            $table->text('pagina_inicial_texto')->nullable();
            $table->string('botao_inicial')->nullable();

            $table->boolean('cardapio')->default(false);

            $table->boolean('prato_dia')->default(false);
            $table->string('prato_dia_titulo')->nullable();
            $table->text('prato_dia_texto')->nullable();

            $table->boolean('encomendas')->default(false);
            $table->string('encomendas_titulo')->nullable();
            $table->text('encomendas_texto')->nullable();

            $table->boolean('novidades')->default(false);

            $table->boolean('horario')->default(false);

            $table->integer('evento_id')->nullable();

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
        Schema::dropIfExists('configuracaos');
    }
}
