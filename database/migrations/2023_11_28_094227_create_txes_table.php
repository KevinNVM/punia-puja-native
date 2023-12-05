<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('txes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('phone');
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->string('events')->nullable();
            $table->text('proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('txes');
    }
};
