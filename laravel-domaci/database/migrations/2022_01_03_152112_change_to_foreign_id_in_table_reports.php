<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToForeignIdInTableReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->foreignId('patientId')->change();
            $table->foreignId('doctorId')->change(); 
            $table->foreignId('patientStatus')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->integer('patientId')->change();
            $table->integer('doctorId')->change(); 
            $table->integer('patientStatus')->change(); 
        });
    }
}
