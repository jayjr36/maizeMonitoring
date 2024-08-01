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
        Schema::create('maize_data', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->decimal('height', 8, 2);
            $table->decimal('thickness', 8, 2);
            $table->string('color');
            $table->string('defective');
            $table->string('deficiency');
            $table->string('suggestion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maize_data');
    }
};
