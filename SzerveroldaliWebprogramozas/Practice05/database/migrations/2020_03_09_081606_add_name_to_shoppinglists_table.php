<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToShoppinglistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shoppinglists', function (Blueprint $table) {

            //
            // Lásd:
            //
            //  https://laravel.com/docs/7.x/migrations#creating-columns
            //  https://laravel.com/docs/7.x/migrations#column-modifiers
            //

            $table->string('name', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppinglists', function (Blueprint $table) {
            //
        });
    }
}
