<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_request_id')->constrained('repair_requests')->onDelete('cascade');
            $table->enum('status', ['new', 'assigned', 'in_progress', 'completed', 'closed', 'cancelled']);
            $table->text('comment')->nullable();
            $table->foreignId('changed_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->index('repair_request_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_statuses');
    }
};
