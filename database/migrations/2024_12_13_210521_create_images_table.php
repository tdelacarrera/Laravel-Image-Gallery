<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function(Blueprint $table){
            $table->id();
            $table->string('path')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();
        });
        
    }
    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
