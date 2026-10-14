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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_type')->default('Cash on Delivery');
            $table->string('order_status')->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
