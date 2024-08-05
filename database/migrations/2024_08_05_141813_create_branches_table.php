<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * النيابات
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->foreignId("governorate_id")->nullable()->comment("محافظة الموظف")->references("id")->on("governorates")->onUpdate("cascade");
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('branches')->insert([
            [
                'name' => 'الأسماعيلية القسم الأول',
                'governorate_id' => 4,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);

        DB::table('branches')->insert([
            [
                'name' => 'السويس القسم الأول',
                'governorate_id' => 7,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);


        DB::table('branches')->insert([
            [
                'name' => 'نيابة التعليم القسم الأول',
                'governorate_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);


        DB::table('branches')->insert([
            [
                'name' => 'نيابة الصحه القسم الثانى',
                'governorate_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);

        DB::table('branches')->insert([
            [
                'name' => 'رئاسة الهيئة',
                'governorate_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);


        DB::table('branches')->insert([
            [
                'name' => 'نيابة الأسكان القسم الثالث',
                'governorate_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);


        DB::table('branches')->insert([
            [
                'name' => 'نيابة الأزهر',
                'governorate_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
