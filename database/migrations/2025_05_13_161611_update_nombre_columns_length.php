<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_update_nombre_columns_length.php

public function up()
{
    Schema::table('departamentos', function (Blueprint $table) {
        $table->string('nombre', 50)->change();
    });

    Schema::table('ciudad', function (Blueprint $table) {
        $table->string('nombre', 50)->change();
    });
}

public function down()
{
    Schema::table('departamentos', function (Blueprint $table) {
        $table->string('nombre', 255)->change(); 
    });

    Schema::table('ciudad', function (Blueprint $table) {
        $table->string('nombre', 255)->change();
    });
}
};
