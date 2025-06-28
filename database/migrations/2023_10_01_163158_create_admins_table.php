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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('username',100)->index();
            $table->string('email')->index();
            $table->string('password')->nullable();
            $table->string('image')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('mobile_code',10)->nullable();
            $table->string('phone',50)->nullable()->index();
            $table->text('address')->nullable();
            $table->string('device_id')->nullable();
            $table->text('device_info')->nullable();
            $table->timestamp("last_logged_in")->nullable();
            $table->timestamp("last_logged_out")->nullable();
            $table->enum('status',[1,2])->default(1)->comment('1 = Active, 2 = Inactive');
            $table->boolean('delatable')->default(true);
            $table->boolean("login_status")->default(false);
            $table->string("created_by")->nullable();
            $table->string("updated_by")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
