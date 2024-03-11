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
        Schema::create('usecase_user_input', function (Blueprint $table) {
            $table->timestamps();
            $table->bigInteger('user_input_id', false, true);
            $table->bigInteger('usecase_id', false, true);
            $table->primary(['user_input_id', 'usecase_id']);
            $table->foreign('usecase_id')->references('id')->on('usecases')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('user_input_id')->references('id')->on('user_inputs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('usecase_user_input');
    }
};
