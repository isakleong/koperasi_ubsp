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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->required();
            $table->string('lname')->required();
            $table->string('birthplace')->required();
            $table->date('birthdate')->required();
            $table->string('address')->required();
            $table->string('workAddress')->required();
            $table->string('phone')->required();
            $table->string('ktp')->required();
            $table->string('kk')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
