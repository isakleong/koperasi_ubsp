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
        Schema::create('loan_detail', function (Blueprint $table) {
            $table->id();
            $table->string('loanDocId')->required();
            $table->foreign('loanDocId')->references('docId')->on('loan')->onDelete('restrict');
            $table->integer('indexCicilan');
            $table->timestamp('dueDate');
            $table->timestamp('transactionDate')->nullable();
            $table->bigInteger('total');
            $table->bigInteger('charges');
            $table->tinyInteger('method');
            $table->string('image')->nullable();
            $table->string('notes');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('approvedOn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_detail');
    }
};
