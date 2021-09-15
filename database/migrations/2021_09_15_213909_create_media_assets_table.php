<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_assets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('is_public')->default(0);
            $table->string('name');
            $table->string('filename');
            $table->longText('description');
            $table->foreignId('owner_model_id')->nullable();
            $table->string('owner_model_class')->nullable();
            $table->string('reference')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_assets');
    }
}
