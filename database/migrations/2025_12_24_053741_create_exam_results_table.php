<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->restrictOnDelete();
            $table->foreignId('exam_id')->constrained()->restrictOnDelete();
            $table->foreignId('subject_id')->constrained()->restrictOnDelete();
            $table->decimal('obtained_marks', 6, 2);
            $table->decimal('total_marks', 6, 2);
            $table->string('grade')->nullable();
            $table->decimal('percentage', 5, 2);
            $table->text('remarks')->nullable();
            $table->foreignId('graded_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();

            $table->unique(['student_id', 'exam_id', 'subject_id']);
            $table->index(['student_id', 'exam_id']);
            $table->index(['exam_id', 'subject_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_results');
    }
};
