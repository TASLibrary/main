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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('usage_likelihood_rating');
            $table->text('usage_likelihood_reason')->nullable();
            $table->text('positive_points')->nullable();
            $table->text('negative_points')->nullable();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('usecase_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign('evaluations_user_id_foreign');
            $table->dropForeign('evaluations_usecase_id_foreign');
        });
        Schema::dropIfExists('evaluations');
    }
};
