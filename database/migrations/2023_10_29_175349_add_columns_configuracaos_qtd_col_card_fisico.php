<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsConfiguracaosQtdColCardFisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracaos', function (Blueprint $table) {
            $table->integer('cardapio_fisico_qtd')->nullable()->after('evento_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuracaos', function (Blueprint $table) {
            $table->dropColumn('cardapio_fisico_qtd');
        });
    }
}
