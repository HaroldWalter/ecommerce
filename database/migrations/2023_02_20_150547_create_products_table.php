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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->text("description");
            $table->decimal("price", 9, 2);
            $table->decimal("vat", 5, 2);
            // $table->string("image", 2000);
            $table->string("image", 2000)->nullable(); // Par défaut, ne pas le faire même si champ optionnel, cependant peut régler problèmes de DB qui refuse données null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
