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
        Schema::table('projects', function (Blueprint $table) {
            // aggiungo il nuovo campo
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // aggiungo il vincolo delle relazione
            $table->foreign('type_id')->references('id')
            ->on('types')->onDelete('set null')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // rimuovo il vincolo della relazione
            $table->dropForeign(['type_id']);
            // elimino la colonna type_id
            $table->dropColumn('type_id');

        });
    }
};
