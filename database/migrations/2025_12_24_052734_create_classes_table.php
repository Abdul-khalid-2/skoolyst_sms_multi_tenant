<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->foreignId('academic_year_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('code')->nullable();
            $table->integer('order_no')->default(0);
            $table->string('education_system')->default('matric');
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->foreignId('next_class_id')->nullable()->constrained('classes')->nullOnDelete();
            $table->boolean('enable_sections')->default(true);
            $table->string('status')->default('active');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'academic_year_id']);
            $table->index(['school_id', 'education_system']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
};
