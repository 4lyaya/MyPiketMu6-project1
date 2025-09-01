<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('absent_teacher_id');
            $table->unsignedBigInteger('substitute_teacher_id');
            $table->unsignedBigInteger('classroom_id');

            $table->dateTime('replaced_at')->useCurrent();
            $table->unsignedSmallInteger('periods_mask')->default(0);
            $table->enum('reason', ['sakit', 'alpha', 'izin', 'terlambat', 'tugas_sekolah']);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('absent_teacher_id', 'fk_absence_absent_teacher')
                ->references('id')->on('teachers')->cascadeOnDelete();

            $table->foreign('substitute_teacher_id', 'fk_absence_substitute_teacher')
                ->references('id')->on('teachers')->cascadeOnDelete();

            $table->foreign('classroom_id', 'fk_absence_classroom')
                ->references('id')->on('classrooms')->cascadeOnDelete();

            $table->index(
                ['absent_teacher_id', 'substitute_teacher_id', 'classroom_id'],
                'idx_absence_teacher_class'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
