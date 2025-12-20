<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();  // e.g., 'school_management', 'user_management'
            $table->string('name');            // Display name
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // Font awesome or custom icon class
            $table->string('route')->nullable(); // Default route for module
            $table->integer('order')->default(0); // Display order in sidebar
            $table->boolean('is_core')->default(false); // Core modules cannot be disabled
            $table->boolean('is_active')->default(true); // Global active status
            $table->json('permissions')->nullable(); // Module-specific permissions array
            $table->json('submodules')->nullable(); // Submodule definitions
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
