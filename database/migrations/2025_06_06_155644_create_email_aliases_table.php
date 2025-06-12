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
        Schema::create('email_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temporary_email_id')->constrained()->onDelete('cascade');
            $table->string('real_email');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_aliases');
    }
};
