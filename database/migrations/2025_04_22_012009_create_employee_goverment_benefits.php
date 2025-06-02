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
        Schema::create('employee_goverment_benefits', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('sss_number');
            $table->string('pagibig_number');
            $table->string('philhealth_number');
            $table->string('tin_number');
            $table->string('healthcare_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_goverment_benefits');
    }
};
