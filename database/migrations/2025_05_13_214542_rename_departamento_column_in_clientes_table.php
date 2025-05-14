<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::table('clientes', function (Blueprint $table) {
       
        if (Schema::hasColumn('clientes', 'Departamento')) {
            
            $table->dropColumn('Departamento');
        }
        
        
        if (!Schema::hasColumn('clientes', 'departamento_id')) {
            $table->foreignId('departamento_id')
                  ->constrained('departamentos')
                  ->onDelete('cascade');
        }
    });
}

public function down() {
    Schema::table('clientes', function (Blueprint $table) {
        $table->dropForeign(['departamento_id']);
        $table->dropColumn('departamento_id');
        
        
        $table->string('Departamento', 22);
    });
}
};
