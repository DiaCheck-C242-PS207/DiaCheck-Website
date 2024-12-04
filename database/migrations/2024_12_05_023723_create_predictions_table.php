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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('gender');
            $table->integer('age');
            $table->boolean('hypertension');
            $table->boolean('heart_disease');
            $table->float('bmi', 5, 2);
            $table->float('HbA1c_level', 5, 2);
            $table->float('blood_glucose_level', 5, 2);
            $table->string('prediction');
            $table->float('probability');
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
