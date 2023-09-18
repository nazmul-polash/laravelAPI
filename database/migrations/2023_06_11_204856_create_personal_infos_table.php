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
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->bigIncrements('personal_info_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('designation_id');
            $table->text('full_address')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('video')->nullable();
            $table->string('audio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
