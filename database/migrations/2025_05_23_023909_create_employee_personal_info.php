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
        Schema::create('employee_personal_info', function (Blueprint $table) {
            $table->id();
            $table->string('profile_filename')->nullable();
            $table->string('firstname',500);
            $table->string('middlename',500)->nullable();
            $table->string('lastname',500);
            $table->string('suffix',250)->nullable();
            $table->string('gender',250);
            $table->date('birthdate');
            $table->string('civil_status',250);
            $table->string('nationality',250);
            $table->string('addedbyID');
            $table->string('updatedbyID')->nullable();
            $table->boolean('isCurrent')->default(1);
            $table->boolean('isDeleted')->default(0);
            $table->datetime('dateAdded')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_personal_info');
    }
};
