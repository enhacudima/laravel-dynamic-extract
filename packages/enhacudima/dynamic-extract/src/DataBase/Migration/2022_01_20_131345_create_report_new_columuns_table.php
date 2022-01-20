<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportNewColumunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_new_columuns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->bigInteger('report_new_filtro_id')->unsigned();
            $table->integer('status')->default(1);

             $table->foreignId('user_id')->constrained('users');
            $table->foreign('report_new_filtro_id')->references('id')->on('report_new_filtro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_new_columuns');
    }
}
