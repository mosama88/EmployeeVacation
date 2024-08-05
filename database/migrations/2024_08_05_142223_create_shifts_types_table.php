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
        Schema::create('shifts_types', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('نوع الشيفت: واحد صباحى و أثنين مسائى');
            $table->time('from_time');
            $table->time('to_time');
            $table->decimal('total_hours', 10, 2);
            $table->tinyInteger('status')->default(1)->comment('واحد نشط غير نشط أثنين');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts_types');
    }
};
