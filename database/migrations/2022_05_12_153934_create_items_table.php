<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            $table->string('description')->nullable();
            $table->string('name');
            $table->string('icon');
            $table->boolean('has_icon')->default(true);
            $table->string('collectible_hash');
            $table->string('icon_watermark');
            $table->string('screenshot');
            $table->text('flavor_text');
            $table->integer('tier_type_code');
            $table->integer('ammo_type_code');
            $table->integer('item_type_code');
            $table->integer('item_sub_type_code');
            $table->integer('class_type_code');
            $table->integer('damage_type_code');
            $table->string('lore_hash')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
