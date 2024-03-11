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
        Schema::table('characteristics', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()
                ->constrained(table: 'characteristics', column: 'id', indexName: 'characteristic_parent_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('description', 4096);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('characteristics', function (Blueprint $table) {
            $table->dropForeign('characteristic_parent_id');
            $table->dropColumn('description');
        });
    }
};
