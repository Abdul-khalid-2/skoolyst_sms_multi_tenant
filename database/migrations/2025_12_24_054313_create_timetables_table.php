<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->foreignId('class_id')->constrained()->restrictOnDelete();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('academic_year_id')->constrained()->restrictOnDelete();
            $table->string('day');
            $table->integer('period_no');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('subject_id')->constrained()->restrictOnDelete();
            $table->foreignId('teacher_id')->constrained()->restrictOnDelete();
            $table->string('room')->nullable();
            $table->boolean('is_break')->default(false);
            $table->string('break_type')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();

            $table->unique(
                ['class_id', 'section_id', 'day', 'period_no', 'academic_year_id'],
                'timetables_unique_schedule'
            );
            $table->index(['teacher_id', 'day', 'period_no']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('timetables');
    }
};
