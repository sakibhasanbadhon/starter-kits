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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username',191)->unique();
            $table->string('email', 119)->unique();
            $table->string('mobile_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('full_mobile', 191)->nullable()->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->text('address')->nullable();
            $table->boolean('email_verified')->comment('1 == Verifiend, 0 == Not verifiend')->default(false);
            $table->boolean('sms_verified')->comment('1 == Verifiend, 0 == Not verifiend')->default(false);
            $table->boolean('kyc_verified')->comment("0: Default, 1: Approved, 2: Pending, 3:Rejected")->default(0);
            $table->boolean('two_factor_verified')->default(false);
            $table->boolean('two_factor_status')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->string('device_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->comment('1 = Active, 0 == Banned')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
