<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('from');
            $table->date('to');
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('holidays')->delete();
        DB::table('holidays')->insert([
            'name' => 'عيد الميلاد المجيد',
            'from' => '2024-01-07',
            'to' => '2024-01-07',
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('holidays')->insert([
            'name' => 'عيد الشرطة',
            'from' => '2024-01-25',
            'to' => '2024-01-25',
            'created_by' => 1,
            'updated_by' => 1,
        ],);


        DB::table('holidays')->insert([
            'name' => 'عيد الفطر المبارك',
            'from' => '2024-04-9',
            'to' => '2024-04-14',
            'created_by' => 1,
            'updated_by' => 1,
        ],);


        DB::table('holidays')->insert([
            'name' => 'عيد تحرير سيناء',
            'from' => '2024-04-25',
            'to' => '2024-04-25',
            'created_by' => 1,
            'updated_by' => 1,
        ],);


        DB::table('holidays')->insert([
            'name' => 'عيد العمال',
            'from' => '2024-05-01',
            'to' => '2024-05-01',
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('holidays')->insert([
            'name' => 'عيد شم النسيم',
            'from' => '2024-05-06',
            'to' => '2024-05-06',
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('holidays')->insert([
            'name' => 'وقفة عيد الأضحى',
            'from' => '2024-06-15',
            'to' => '2024-06-15',
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('holidays')->insert([
            'name' => 'عيد الأضحى المبارك',
            'from' => '2024-06-16',
            'to' => '2024-06-19',
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('holidays')->insert([
            'name' => 'ثورة ٣٠ يونيو',
            'from' => '2024-06-30',
            'to' => '2024-06-30',
            'created_by' => 1,
            'updated_by' => 1,
        ],);


        DB::table('holidays')->insert([
            'name' => 'رأس السنة الهجرية',
            'from' => '2024-07-08',
            'to' => '2024-07-08',
            'created_by' => 1,
            'updated_by' => 1,
        ],);


        DB::table('holidays')->insert([
            'name' => 'ثورة ٢٣ يوليو ١٩٥٢',
            'from' => '2024-07-23',
            'to' => '2024-07-23',
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('holidays')->insert([
            'name' => 'المولد النبوي الشريف',
            'from' => '2024-09-16',
            'to' => '2024-09-16',
            'created_by' => 1,
            'updated_by' => 1,
        ],);

        DB::table('holidays')->insert([
            'name' => '٦ أكتوبر',
            'from' => '2024-10-06',
            'to' => '2024-10-06',
            'created_by' => 1,
            'updated_by' => 1,
        ],);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};
