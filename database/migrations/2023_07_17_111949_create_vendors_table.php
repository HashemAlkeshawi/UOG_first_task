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
        /***
         * Table vendors {
            id bigInt [primary key]
            email varchar
            first_name varchar
            last_name varchar
            is_active tinyInteger
            phone varchar
            created_at timestamp
            updated_at timestamp
}

         */
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('is_active')->default(1);
            $table->string('phone');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
