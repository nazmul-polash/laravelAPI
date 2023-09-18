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
        Schema::create('favourite_books', function (Blueprint $table) {
            $table->bigIncrements('favourite_book_id');
            $table->unsignedBigInteger('ref_personal_info_id');
            $table->string('book_name',150); 
            $table->string('writer_name',100); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_books');
    }
};
