<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->json('specialization')->nullable();
            $table->integer('experience_years')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->integer('total_repairs')->default(0);
            $table->integer('total_reviews')->default(0);
            $table->text('bio')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();

            $table->index('average_rating');
            $table->index('available');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_profiles');
    }
};
