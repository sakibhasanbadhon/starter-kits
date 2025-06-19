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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('type',255);
            $table->string('slug',200)->unique()->nullable();
            $table->text("title")->nullable();
            $table->string("url",255)->nullable();
            $table->longText("details")->nullable();
            $table->foreignId('edit_by')->nullable()->constrained('admins')->cascadeOnDelete();
            $table->boolean("status")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
