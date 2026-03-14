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
        Schema::create('adminlist', function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->text('full_name');
            $table->text('email')->unique();
            $table->text('password');
            $table->text('position');
            $table->text('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adminlist');
    }
};
