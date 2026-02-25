<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('accommodations', 'bathrooms')) {
            Schema::table('accommodations', function (Blueprint $table) {
                $table->unsignedTinyInteger('bathrooms')->default(0)->after('bedrooms');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('accommodations', 'bathrooms')) {
            Schema::table('accommodations', function (Blueprint $table) {
                $table->dropColumn('bathrooms');
            });
        }
    }
};
