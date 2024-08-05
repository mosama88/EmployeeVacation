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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('name_en', 50);
            $table->timestamps();
        });

        DB::table('appointments')->insert(
            [
                ['name' => 'السبت', 'name_en' => 'Saturday'],
                ['name' => 'الأحد', 'name_en' => 'Sunday'],
                ['name' => 'الاثنين', 'name_en' => 'Monday'],
                ['name' => 'الثلاثاء', 'name_en' => 'Tuesday'],
                ['name' => 'الأربعاء', 'name_en' => 'Wednesday'],
                ['name' => 'الخميس', 'name_en' => 'Thursday'],
                ['name' => 'الجمعة', 'name_en' => 'Friday'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
