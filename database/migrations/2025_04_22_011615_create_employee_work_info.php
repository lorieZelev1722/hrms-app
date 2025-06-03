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
        Schema::create('employee_work_info', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('department_id');
            $table->integer('employment_type');
            $table->date('start_date');
            $table->boolean('status')->default(1);
            $table->integer('supervisor_id');
            $table->integer('team_id');
            $table->integer('addedbyID');
            $table->integer('updatedbyID');
            $table->boolean('isCurrent')->default(1);
            $table->boolean('isDeleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_work_info');
    }
};
