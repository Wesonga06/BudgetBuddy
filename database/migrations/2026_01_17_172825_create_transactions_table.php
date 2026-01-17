<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 15, 2);
        $table->string('type'); // 'income' or 'expense'
        $table->string('source'); // 'mpesa' or 'bank'
        $table->string('description')->nullable();
        $table->timestamps();
    });
}
};
