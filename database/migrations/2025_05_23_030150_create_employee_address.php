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
        Schema::create('employee_address', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('country',250);
            $table->string('province',250);
            $table->string('town',250);
            $table->string('baranggay',250);
            $table->string('zipcode',250);
            $table->string('current_address');
            $table->string('temporary_address');
            $table->string('addedbyID');
            $table->string('updatedbyID')->nullable();
            $table->boolean('isCurrent')->default(1);
            $table->boolean('isDeleted')->default(0);
            $table->datetime('dateAdded')->current();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_address');
    }
};
