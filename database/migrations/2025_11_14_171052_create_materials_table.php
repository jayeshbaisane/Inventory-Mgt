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
    Schema::create('materials', function (Blueprint $table) 
        {
        $table->id();
        $table->unsignedBigInteger('category_id'); // FK
        $table->string('material_name');
        $table->decimal('opening_balance', 10, 2); // two decimals
        $table->integer('internal_material_id')->unique(); // auto internal id
        $table->timestamps();
        $table->softDeletes();

        // Foreign Key
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
