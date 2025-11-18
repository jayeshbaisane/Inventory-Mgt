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
    Schema::create('inwards', function (Blueprint $table) 
    {
        $table->id();
        $table->unsignedBigInteger('category_id'); // selected category
        $table->unsignedBigInteger('material_id'); // selected material
        $table->enum('type', ['inward', 'outward']);
        $table->decimal('quantity', 10, 2); // inward/outward (+/-)
        $table->date('entry_date');
        $table->integer('internal_inward_id')->unique(); // auto id
        $table->timestamps();

        // Foreign Keys
        $table->foreign('category_id')->references('id')->on('categories');
        $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inwards');
    }
};
