<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventMemberRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_member_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('email');
            $table->string('address')->nullable();
            $table->integer('member_category_id');
            $table->integer('organizer_id')->nullable();
            $table->string('payment_transaction_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('user_id');
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
        Schema::dropIfExists('event_member_registrations');
    }
}
