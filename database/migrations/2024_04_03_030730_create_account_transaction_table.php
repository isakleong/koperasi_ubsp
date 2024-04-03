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
        Schema::create('account_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('docId')->unique();
            $table->string('memberId')->required();
            $table->foreign('memberId')->references('memberId')->on('users')->onDelete('restrict');
            $table->timestamp('transactionDate')->nullable();
            $table->bigInteger('totalDebit');
            $table->bigInteger('totalKredit');
            $table->tinyInteger('method');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_transaction');
    }
};