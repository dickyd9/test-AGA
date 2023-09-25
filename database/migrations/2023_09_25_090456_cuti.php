<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_employee'); // Kolom "id_employee" dengan tipe data unsignedBigInteger
            $table->foreign('id_employee')->references('id')->on('pegawai'); // Menambahkan foreign key ke tabel "pegawai"
            $table->date('cuti_date');
            $table->integer('lama');
            $table->string('keterangan');
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
        Schema::dropIfExists('cuti');
    }
}
