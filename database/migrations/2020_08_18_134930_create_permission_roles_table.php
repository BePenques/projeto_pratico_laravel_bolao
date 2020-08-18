<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();//unsigned - so numeros positivos
            $table->integer('role_id')->unsigned();//unsigned - so numeros positivos
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_role', function (Blueprint $table) {
           $table->dropForeign('permission_role_role_id_foreign');//nometabela + nomeforeignkey + Foreign
           $table->dropForeign('permission_role_permission_id_foreign');
        });
        Schema::dropIfExists('permission_role');
    }
}
