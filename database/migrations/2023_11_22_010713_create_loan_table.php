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
        Schema::create('loan', function (Blueprint $table) {
            $table->string('docId')->primary();
            $table->string('accountId')->required();
            $table->foreign('accountId')->references('accountId')->on('user_account')->onDelete('restrict');
            $table->bigInteger('total');
            $table->integer('tenor');
            $table->float('rates');
            $table->bigInteger('baseCicilan');
            $table->bigInteger('monthlyCicilan');
            $table->string('notes');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('requestDate')->nullable();
            $table->timestamp('approvedOn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan');
    }
};
