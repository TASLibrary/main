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
        Schema::create('usecase_user', function (Blueprint $table) {
            $table->timestamps();
            $table->bigInteger('usecase_id', false, true);
            $table->bigInteger('user_id', false, true);
            $table->primary(['usecase_id', 'user_id']);
            $table->foreign('usecase_id')->references('id')->on('usecases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usecase_user');
    }
};
