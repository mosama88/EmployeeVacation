<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * الدرجه الوظيفية
     */
    public function up(): void
    {
        Schema::create('job_grades', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->timestamps();
        });
        DB::table('job_grades')->delete();
        DB::table('job_grades')->insert([
            'name' => 'الاولى أ',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
        DB::table('job_grades')->insert([
            'name' => 'الاولى ب',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
        DB::table('job_grades')->insert([
            'name' => 'الثانية أ',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
        DB::table('job_grades')->insert([
            'name' => 'الثانية ب',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
        DB::table('job_grades')->insert([
            'name' => 'الثالثه أ',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
        DB::table('job_grades')->insert([
            'name' => 'الثالثه ب',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
        DB::table('job_grades')->insert([
            'name' => 'الثالثه ج',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_grades');
    }
};
