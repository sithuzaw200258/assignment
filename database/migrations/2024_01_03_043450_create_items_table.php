<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string("name");
            $table->string("slug");
            $table->foreignId("category_id")->constrained()->cascadeOnDelete();
            $table->string('price');
            $table->longText("description");
            $table->text("excerpt");
            $table->enum("item_condition",['new','used','good second hand'])->nullable()->default('new');
            $table->enum("item_type",['sell','buy','exchange'])->nullable()->default('sell');
            $table->enum("status",['0','1'])->nullable()->default('0');
            $table->string("item_photo")->nullable();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger("owner_id")->constrained()->cascadeOnDelete();
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
};
