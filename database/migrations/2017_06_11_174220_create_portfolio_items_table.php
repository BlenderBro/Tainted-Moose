<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('portfolio_items', function (Blueprint $table){
            $table->increments('id');
            $table->string('title')->unique();
            $table->text('body');
            $table->string('slug')->unique();
            $table->string('client');
			$table->string('services');
            $table->string('featured_image')->default('default_feat.png');
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
         Schema::drop('portfolio_items');
    }
}
