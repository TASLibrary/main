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
        Schema::create('usecases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 511);
            $table->text('description');
            $table->string('source', 511);
            $table->tinyInteger('origin');
            $table->string('standout_characteristics', 511);
            $table->string('limitations', 511);
            $table->text('link');
            $table->text('rri');
            $table->tinyInteger('acknowledgement');
            $table->tinyInteger('status');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usecases', function (Blueprint $table) {
            $table->dropForeign('usecases_user_id_foreign');
        });
        Schema::dropIfExists('usecases');
    }
};
