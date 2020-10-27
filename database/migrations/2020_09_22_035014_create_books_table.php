<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->integer('totalPages')->default('234');
            $table->integer('price')->default('500');
            $table->string('ISBN')->default('AEWS23');
            $table->string('category')->default('religion');
            // $table->foriegnId('author_id')->constrained('authors')->onDelete('cascade');
            // $table->foriegnId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('publish_date')->default('01/10/1998');
            $table->string('publisher_id')->default('1');
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
        Schema::dropIfExists('books');
    }
}
