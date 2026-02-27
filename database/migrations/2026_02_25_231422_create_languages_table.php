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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique()->comment('Language display name');
            $table->string('code', 20)->unique()->comment('ISO language code');
            $table->boolean('status')->default(true)->comment('language status on the site');
            $table->enum('direction', ['ltr', 'rtl'])->default('ltr')->comment('Text direction');
            $table->integer('modified_by')->nullable()->comment('Admin who last modified');
            $table->timestamps();

            // Indexes for better performance
            $table->index(['code', 'status'], 'idx_active_locales');
        });

        // Insert default languages
        $this->seedDefaultLocales();
    }

    /**
     * Seed default languages after table creation
     */
    private function seedDefaultLocales(): void
    {
        $defaultLocales = [
            [
                'name' => 'English',
                'code' => 'en',
                'direction' => 'ltr',
                'status' => true,
            ],
            [
                'name' => 'Spanish',
                'code' => 'es',
                'direction' => 'ltr',
                'status' => false,
            ],
            [
                'name' => 'French',
                'code' => 'fr',
                'direction' => 'ltr',
                'status' => false,
            ],
            [
                'name' => 'Arabic',
                'code' => 'ar',
                'direction' => 'rtl',
                'status' => false,
            ],
            [
                'name' => 'Chinese',
                'code' => 'zh',
                'direction' => 'ltr',
                'status' => false,
            ],

        ];

        // Get the first admin user ID (or create a system user reference)
        $firstAdminId = DB::table('admins')->value('id') ?? 1;

        foreach ($defaultLocales as $locale) {
            $locale['modified_by'] = $firstAdminId;
            $locale['created_at'] = now();
            $locale['updated_at'] = now();

            DB::table('languages')->insert($locale);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};

