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
        Schema::create('addressee_lists', function (Blueprint $table) {
            $table->id();
            $table->string('abbrev');
            $table->string('name_primary');
            $table->string('name_secondary');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->string('province');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addressee_lists');
    }
};
