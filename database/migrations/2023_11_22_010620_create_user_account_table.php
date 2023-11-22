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
        Schema::create('user_account', function (Blueprint $table) {
            $table->string('accountId')->primary();
            $table->string('memberId')->required();
            $table->foreign('memberId')->references('memberId')->on('users')->onDelete('restrict');
            $table->string('kind');
            $table->bigInteger('balance');
            $table->timestamp('openDate')->nullable();
            $table->timestamp('closedDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_account');
    }
};
