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
        Schema::create('journal_entry_detail', function (Blueprint $table) {
            $table->id();
            $table->string('docId')->required();
            $table->foreign('docId')->references('docId')->on('journal_entry')->onDelete('restrict');            
            $table->unsignedBigInteger('accountNo')->required();
            $table->foreign('accountNo')->references('id')->on('account')->onDelete('restrict');
            $table->integer('indexNo');
            $table->string('description');
            $table->bigInteger('debit');
            $table->bigInteger('kredit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entry_detail');
    }
};
