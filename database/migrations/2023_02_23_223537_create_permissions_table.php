<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // edit posts
            $table->string('slug'); // edit-posts
            $table->string('groups')->nullable(); // posts
            $table->string('description')->nullable(); // Permissão para EDITAR posts cadastrados no sistema
            $table->timestamps();
        });

        DB::unprepared(file_get_contents(database_path('seeders/jsons/permissions.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
