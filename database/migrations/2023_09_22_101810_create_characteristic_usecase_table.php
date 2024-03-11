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
        Schema::create('characteristic_usecase', function (Blueprint $table) {
            $table->timestamps();
            $table->bigInteger('characteristic_id', false, true);
            $table->bigInteger('usecase_id', false, true);
            $table->primary(['characteristic_id', 'usecase_id']);
            $table->foreign('usecase_id')->references('id')->on('usecases')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('characteristic_id')->references('id')->on('characteristics')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristic_usecase');
    }
};
