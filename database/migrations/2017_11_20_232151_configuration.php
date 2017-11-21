<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Configuration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        DB::table('users')->insert(
            array(
                'name' => 'UserAdmin',
                'email' => 'useradmin@gmail.com',
                'password' => bcrypt('q1w2e3r4'),
                'role' => 'admin'
            )
        );

        DB::table('indicadores')->insert(
            array(
                'nombre' => 'Indicador EBITDA',
                'activo' => 1,
                'formula' => 'EBITDA',
                'elementosDeFormula' => '[{"id":1,"class":"Cuenta"}]',
                'predefinido' => 1,
                'user_id' => 1,
                'created_at' => new \DateTime()
            )
        );

        DB::table('indicadores')->insert(
            array(
                'nombre' => 'Indicador Antiguedad',
                'activo' => 1,
                'formula' => 'Antigüedad',
                'elementosDeFormula' => '[{"id":0,"class":"Antigüedad"}]',
                'predefinido' => 1,
                'user_id' => 1,
                'created_at' => new \DateTime()
            )
        );

        DB::table('indicadores')->insert(
            array(
                'nombre' => 'Indicador Operaciones Continuas',
                'activo' => 1,
                'formula' => 'Continuing Operations',
                'elementosDeFormula' => '[{"id":5,"class":"Cuenta"}]',
                'predefinido' => 1,
                'user_id' => 1,
                'created_at' => new \DateTime()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
