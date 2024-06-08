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
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->string("accountNo")->unique();
            $table->string("name")->unique();
            $table->unsignedBigInteger('categoryID')->required();
            $table->foreign('categoryID')->references('id')->on('account_category')->onDelete('restrict');
            $table->string('normalBalance', 1)->required();
            $table->bigInteger("balance")->default(0);
            $table->string("description")->nullable();
            $table->string('active', 1)->required();
            $table->timestamps();
            $table->nestedSet();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('account');
        Schema::table('table', function (Blueprint $table){
            $table->dropNestedSet();
        });
    }
};
