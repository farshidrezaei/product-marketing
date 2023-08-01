<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_link_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_link_id')->constrained('product_links')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('ip')->nullable();
            $table->string('agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_link_visits');
    }
};
