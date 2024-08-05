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
        Schema::create('governorates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->timestamps();
        });

        DB::table('governorates')->insert(
            [
                ['name' => 'القاهرة'],
                ['name' => 'الجيزه'],
                ['name' => 'الاسكندرية'],
                ['name' => 'الإسماعيلية'],
                ['name' => 'الدقهلية'],
                ['name' => 'أسيوط'],
                ['name' => 'السويس'],
                ['name' => 'القليوبية'],
                ['name' => 'البحيرة'],
                ['name' => 'الغربية'],
                ['name' => 'دمياط'],
                ['name' => 'كفرالشيخ'],
                ['name' => 'سوهاج'],
                ['name' => 'الأقصر'],
                ['name' => 'أسوان'],
                ['name' => 'الواحات'],
                ['name' => 'الوادي الجديد'],
                ['name' => 'البحر الأحمر'],
                ['name' => 'قنا'],
                ['name' => 'المنيا'],
                ['name' => 'جنوب سيناء'],
                ['name' => 'شمال سيناء'],
                ['name' => 'مطروح'],
                ['name' => 'بنها'],
                ['name' => 'الفيوم'],
                ['name' => 'بنى سويف'],
                ['name' => 'الشرقيه'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governorates');
    }
};
