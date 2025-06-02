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
        Schema::create('login_credentials', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('username',50)->unique();
            $table->string('password');
            $table->integer('user_role_id');
            $table->boolean('is_current')->default(1);
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
            $table->boolean('Is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_credentials');
    }
};
