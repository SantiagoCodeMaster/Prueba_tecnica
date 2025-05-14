<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('ciudad', function (Blueprint $table) {
        $table->id()->first();       // Add id column (primary key, auto-incrementing)
        $table->timestamps();        // Add created_at and updated_at
    });
}


    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('ciudad', function (Blueprint $table) {
        $table->dropColumn(['id', 'created_at', 'updated_at']);
    });
}

};
