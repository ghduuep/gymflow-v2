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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('cpf', 11)->unique();
            $table->string('phone', 9);
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**]
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
