<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Field multi bahasa disimpan dalam JSON
            $table->json('name');
            $table->string('hs_code');
            $table->string('cas_number')->nullable();
            $table->string('image')->nullable();
            $table->json('description');
            $table->json('application')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_keyword')->nullable();
            $table->json('meta_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
