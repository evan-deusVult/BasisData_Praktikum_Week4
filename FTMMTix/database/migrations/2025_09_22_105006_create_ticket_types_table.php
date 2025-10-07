<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTypesTable extends Migration
{
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price')->default(0);
            $table->bigInteger('event_id')->unsigned(); // Pastikan tipe data sesuai
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_types');
    }
}