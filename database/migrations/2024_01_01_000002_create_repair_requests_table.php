<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('master_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('title');
            $table->text('description');
            $table->string('device_type', 100);

            $table->string('device_brand', 100)->nullable();
            $table->string('device_model', 100)->nullable();
            $table->enum('status', ['new', 'assigned', 'in_progress', 'completed', 'closed', 'cancelled'])->default('new');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('final_cost', 10, 2)->nullable();
            $table->timestamp('scheduled_date')->nullable(); // Додаємо scheduled_date
            $table->date('estimated_completion_date')->nullable();
            $table->date('actual_completion_date')->nullable();
            $table->text('client_address')->nullable();
            $table->json('photos')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('client_id');
            $table->index('master_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_requests');
    }
};
