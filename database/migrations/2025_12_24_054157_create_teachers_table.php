<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('school_id')->constrained()->restrictOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('employee_id');
            $table->date('joining_date');
            $table->string('designation');
            $table->string('department')->nullable();
            $table->decimal('salary', 12, 2)->nullable();
            $table->json('qualifications')->nullable();
            $table->string('status')->default('active');
            $table->text('bio')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'employee_id']);
            $table->index(['school_id', 'department']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
