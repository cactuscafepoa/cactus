<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
			$table->increments('id')->autoIncrement();
			$table->integer('categoria_id')->unsigned();
			$table->foreign('categoria_id')->references('id')->on('categorias')->restrictOnDelete();
			$table->string('nome');
			$table->string('slug')->nullable();
			$table->text('descricao')->nullable();
			$table->string('marca')->nullable();
			$table->string('volume')->nullable();
			$table->string('tipo_volume')->nullable();
			$table->string('ncm')->nullable();
			$table->decimal('preco',9,2)->nullable();
			$table->decimal('preco_venda',9,2)->nullable();
			$table->integer('quantidade')->nullable();
			$table->integer('fornecedor_id')->nullable();
			$table->foreign('fornecedor_id')->references('id')->on('fornecedores')->restrictOnDelete();
			$table->string('imagem')->nullable()->default(env('IMAGEM_DEFAULT'));
			$table->text('link')->nullable();
			$table->boolean('destaque')->nullable()->default(false);
			$table->text('destaque_texto')->nullable();
			$table->index(['nome', 'categoria_id']); // se é doce, salgado, refeição etc.
			$table->boolean('encomenda')->default(false);
			$table->decimal('encomenda_preco_venda',9,2)->nullable();
			$table->string('encomenda_quantidade_minima')->nullable();
			$table->string('encomenda_prazo_minimo')->nullable();
			$table->boolean('prato_dia')->default(false);
			$table->boolean('visivel')->default(false);
			$table->boolean('visivel_cardapio_fisico')->default(true);
			$table->timestamps();
			$table->softDeletes();
		});
    }

    public function down()
    {
        Schema::drop('produtos');
    }
}
