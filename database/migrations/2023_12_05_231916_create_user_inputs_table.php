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
        Schema::create('user_inputs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 1023);
            $table->boolean('user_created');
            $table->foreignId('dimension_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_inputs', function (Blueprint $table) {
            $table->dropForeign('user_inputs_dimension_id_foreign');
        });
        Schema::dropIfExists('user_inputs');
    }
};
