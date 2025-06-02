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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->string('employee_image');
            $table->string('firstname',500);
            $table->string('middlename',500)->nullable();
            $table->string('lastname',500);
            $table->string('suffix',100)->nullable();
            $table->integer('age');
            $table->string('birthdate');
            $table->string('status',50);
            $table->string('address_province',500);
            $table->string('address_municipality',500);
            $table->string('address_baranggay',500);
            $table->string('nationality',300);
            $table->string('mobile_number',20);
            $table->string('email',100);
            $table->string('emergency_contact',300);
            $table->string('emergency_contact_number',20);
            $table->boolean('is_current')->default(1);
            $table->boolean('is_deleted')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};
