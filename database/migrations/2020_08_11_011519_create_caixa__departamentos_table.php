<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCaixaDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixa__departamentos', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->bigInteger('id_caixa')->unsigned();

            $table->bigInteger('id_departamento')->unsigned();
            $table->primary(['id_caixa', 'id_departamento']);
            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos')->onDelete('cascade');

            //$table->string('departamento_caixa');
            $table->string('status')->default('Aberta');
            $table->integer('ordem');

           
        });
        
        DB::statement('ALTER TABLE caixa__departamentos MODIFY id_caixa INTEGER NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caixa__departamentos');
    }
}
