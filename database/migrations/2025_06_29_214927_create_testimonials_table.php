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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('position');
            $table->string('company');
            $table->string('image')->nullable();
            $table->text('content');
            $table->integer('rating')->nullable();
            $table->enum('is_social', [1,2])->default(2)->comment('1 = Yes, 2 = No');
            $table->json('social_media')->nullable();
            $table->enum('status', [1,2])->default(2)->comment('1 = Active, 2 = Inactive');
            $table->integer('ordering')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
