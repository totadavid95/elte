<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add1nToListitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listitems', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('shoppinglist_id')->nullable();

            // 1-N kapcsolat
            $table->foreign('shoppinglist_id')->references('id')->on('shoppinglists')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listitems', function (Blueprint $table) {
            //
        });
    }
}
