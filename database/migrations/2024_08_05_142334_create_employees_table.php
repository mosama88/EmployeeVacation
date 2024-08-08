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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique()->nullable();
            $table->string('password', 255)->nullable();
            $table->string('mobile', 20)->unique();
            $table->date('hiring_date')->comment('بداية التعيين');
            $table->date('start_from')->nullable()->comment('بداية العمل بالاداره');
            $table->date('birth_date')->comment('تاريخ الميلاد');
            $table->string('num_vacation_days')->nullable()->comment('عدد ايام رصيد الأجازات');
            $table->string('add_service')->nullable()->comment('أضافة خدمه مثل 3 سنوات تجنيد');
            $table->string('years_service')->nullable()->comment('عدد سنوات الخدمه بالشركة');
            $table->foreignId('appointment_id')->references('id')->on('appointments')->onUpdate('cascade');
            $table->foreignId('governorate_id')->references('id')->on('governorates')->onUpdate('cascade');
            $table->foreignId('city_id')->references('id')->on('cities')->onUpdate('cascade');
            $table->foreignId('branche_id')->references('id')->on('branches')->onUpdate('cascade');
            $table->foreignId('job_category_id')->references('id')->on('job_categories')->onUpdate('cascade');
            $table->foreignId('job_grade_id')->references('id')->on('job_grades')->onUpdate('cascade');
            $table->foreignId('shifts_type_id')->references('id')->on('shifts_types')->onUpdate('cascade');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
