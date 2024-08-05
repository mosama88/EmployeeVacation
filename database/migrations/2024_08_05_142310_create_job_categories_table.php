<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * المسمى الوظيفيى
     */
    public function up(): void
    {
        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->foreignId("job_grade_id")->nullable()->comment("الدرجه الوظيفية للموظف")->references("id")->on("job_grades")->onUpdate("cascade");
            $table->tinyInteger('status')->default(1)->comment('واحد نشط غير نشط أثنين');
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('job_categories')->delete();
        DB::table('job_categories')->insert([
            'name' => 'باحث تنمية أدارية',
            'job_grade_id' => 1,
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('job_categories')->insert([
            'name' => 'خدمات معاون',
            'job_grade_id' => 5,
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('job_categories')->insert([
            'name' => 'كاتب رابع',
            'job_grade_id' => 5,
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ],);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_categories');
    }
};
