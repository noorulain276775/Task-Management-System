<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['pending', 'on-going', 'done'])->default('pending')->comment(
                'pending,on-going,done');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('task_statuses');
    }
   
};
