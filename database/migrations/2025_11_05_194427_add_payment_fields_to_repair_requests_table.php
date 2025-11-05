<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('repair_requests', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->nullable()->after('final_cost');
            $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending')->after('amount');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->timestamp('paid_at')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('repair_requests', function (Blueprint $table) {
            $table->dropColumn(['amount', 'payment_status', 'payment_method', 'paid_at']);
        });
    }
};
