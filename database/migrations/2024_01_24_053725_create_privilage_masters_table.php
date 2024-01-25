<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('privilage_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('privilege');
            $table->text('key');
            $table->text('value');
            $table->text('icon');
            $table->text('title');
            $table->text('route_action', 128);
            $table->tinyInteger('is_active')->default('1');
            $table->tinyInteger('is_enabled')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });


        DB::table('privilage_master')->insert([

            //-------------------------------Administration----------------------------------

            ['privilege' => 'Category', 'key' => 'category', 'value' => 'category', 'icon' => 'mdi-crosshairs-gps menu-icon', 'title' => 'Product Management', 'route_action' =>  json_encode(['read', 'create', 'edit', 'delete']), 'is_enabled' => 1],

            ['privilege' => 'Products', 'key' => 'products', 'value' => 'products', 'icon' => 'mdi-search-web menu-icon', 'title' => 'Product Management', 'route_action' =>  json_encode(['read', 'create', 'edit', 'delete', 'change_password']), 'is_enabled' => 1],

            ['privilege' => 'Stock Listing', 'key' => 'stocks', 'value' => 'stocks', 'icon' => 'mdi-search-web menu-icon', 'title' => 'Stocks Listing', 'route_action' =>  json_encode(['read', 'create', 'edit', 'delete', 'change_password']), 'is_enabled' => 1],

            ['privilege' => 'Cart Items', 'key' => 'carts', 'value' => 'carts', 'icon' => 'mdi-search-web menu-icon', 'title' => 'Cart Products', 'route_action' =>  json_encode(['read', 'create', 'edit', 'delete', 'change_password']), 'is_enabled' => 1],



        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privilage_masters');
    }
};
