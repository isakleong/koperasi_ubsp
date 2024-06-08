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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("memberId")->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('mothername');
            $table->string('fname')->required();
            $table->string('lname')->required();
            $table->string('birthplace')->required();
            $table->date('birthdate')->required();
            $table->string('address')->required();
            $table->string('workAddress')->required();
            $table->string('phone')->required();
            $table->string('nik', 50)->required();
            $table->string('ktp')->required();
            $table->string('kk')->required();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('registDate')->nullable();
            $table->timestamp('joinDate')->nullable();
            $table->timestamp('exitDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
