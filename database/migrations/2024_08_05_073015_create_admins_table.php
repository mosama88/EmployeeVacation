<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 50);
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::table('admins')->insert([
            [
                'name' => 'محمد أسامه',
                'username' => 'mosama',
                'email' => "mosama@dt.com",
                'password' => Hash::make('password'), // Hashing the password using bcrypt
                'phone' => '01228759920',
                'status' => 1,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
