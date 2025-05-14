<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ciudad', function (Blueprint $table) {
            if (!Schema::hasColumn('ciudad', 'departamento_id')) {
                $table->foreignId('departamento_id')
                    ->nullable()
                    ->constrained('departamentos')
                    ->after('nombre');
            }
        });
    }

    public function down()
    {
        Schema::table('ciudad', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
            $table->dropColumn('departamento_id');
        });
    }
};