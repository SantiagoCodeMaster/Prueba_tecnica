<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Rename the table
        Schema::rename('base_cliente', 'clientes');
    }

    public function down()
    {
        
        Schema::rename('clientes', 'base_cliente');
    }
};