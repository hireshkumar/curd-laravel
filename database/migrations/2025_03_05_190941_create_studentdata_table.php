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
        Schema::create('studentdata', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('email', 100)->unique(); 
            $table->string('password');
            $table->string('number'); 
            $table->enum('gender', ['M', 'F', '']); 
            $table->text('city');
            $table->string('state_id'); 
            $table->string('profile_photo')->nullable(); 
            $table->boolean('status')->default(1);        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentdata');
    }
};
