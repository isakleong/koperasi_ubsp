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
        Schema::create('account_transaction_image', function (Blueprint $table) {
            $table->id();
            $table->string('docId')->required();
            $table->foreign('docId')->references('docId')->on('account_transaction')->onDelete('restrict');
            $table->integer('indexNo');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_transaction_image');
    }
};
