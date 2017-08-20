<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->integer('user_id');
        });

        Schema::table('cuentas', function (Blueprint $table) {
            $table->integer('user_id');
        });

        Schema::table('cuenta_empresa', function (Blueprint $table) {
            $table->integer('user_id');
        });

        Schema::table('indicadores', function (Blueprint $table) {
            $table->integer('user_id');
        });

        Schema::table('metodologias', function (Blueprint $table) {
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
