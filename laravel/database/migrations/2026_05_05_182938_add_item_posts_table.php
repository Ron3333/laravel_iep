<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::table('posts', function (Blueprint $table) {
            // Añade aquí tu nueva columna
             $table->string('item',20)->nullable()->after('image');
             // $table->string('telefono')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('item');
        });
    }
};
