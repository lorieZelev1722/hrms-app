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
        Schema::create('employee_contact_info', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('mobile_no',15);
            $table->string('landline_no',250)->nullable();
            $table->string('email_address',250);
            $table->string('addedbyID');
            $table->string('updatedbyID');
            $table->datetime('dateAdded')->current();
            $table->boolean('isCurrent')->default(1);
            $table->boolean('isDeleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_contact_info');
    }
};
