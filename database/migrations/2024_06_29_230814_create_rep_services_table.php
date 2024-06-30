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
        Schema::create('rep_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_product_id')->constrained();
            $table->decimal('price', 10, 2)->default(0);
            $table->string("notes")->nullable();
            $table->char('status', 1)->default("P"); // P = Pending, A = Approved, R = Rejected
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rep_services');
    }
};
