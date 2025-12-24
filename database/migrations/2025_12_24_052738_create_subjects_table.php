<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('code');
            $table->string('type')->default('theory');
            $table->string('category')->nullable();
            $table->decimal('credit_hours', 4, 1)->nullable();
            $table->integer('total_marks')->nullable();
            $table->integer('passing_marks')->nullable();
            $table->integer('weekly_periods')->default(5);
            $table->integer('period_duration')->default(40);
            $table->boolean('is_optional')->default(false);
            $table->boolean('has_lab')->default(false);
            $table->boolean('enable_exams')->default(true);
            $table->boolean('enable_homework')->default(true);
            $table->foreignId('default_teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('short_description')->nullable();
            $table->text('syllabus')->nullable();
            $table->text('objectives')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'code']);
            $table->index(['school_id', 'category']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
