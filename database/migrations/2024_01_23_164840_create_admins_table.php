<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('role_id');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('admins')->insert(
            array(
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'role_id' => 1,
                'password' => bcrypt('admin'),
                'created_by' => 1,
                'updated_by' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
