<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 
     *السنه المالية
     */
    public function up(): void
    {
        Schema::create('finance_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('finance_yr');
            $table->string('finance_yr_desc', 225); //تفاصيل كود السنه المالية
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('is_open')->default(1); //غير مفعله او مفعله
            $table->integer('com_code')->nullable();
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
        Schema::dropIfExists('finance_calendars');
    }
};
