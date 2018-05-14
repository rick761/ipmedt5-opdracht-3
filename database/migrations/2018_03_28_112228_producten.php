<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Producten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producten',function(Blueprint $table){
            $table->uuid('id');
            $table->primary('id');
            $table->string('naam');

            $table->uuid('user_id');
            $table->uuid('share_id')->nullable($value = true);
            $table->enum('share_status',
                [   'owner',
                    'pending_uitgeleend',
                    'uitgeleend',
                    'pending_terug'
                ]);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('share_id')->references('id')->on('users');
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
        //
    }
}
