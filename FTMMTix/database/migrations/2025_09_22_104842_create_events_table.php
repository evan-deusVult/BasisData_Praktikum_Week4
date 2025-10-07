<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Kolom id secara default adalah bigint unsigned
            $table->string('title');
            $table->string('slug');
            $table->string('poster_path')->nullable();
            $table->string('venue')->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->integer('price')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}