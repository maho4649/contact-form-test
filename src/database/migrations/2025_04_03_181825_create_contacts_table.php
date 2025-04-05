<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            if (Schema::hasColumn('contacts', 'last_name')){
                $table->dropColumn('last_name');
            }
            
            $table->string('name');
            $table->string('gender');
            $table->string('email');
            $table->string('tel', 15);
            $table->text('address')->nullable();
            $table->text('building')->nullable();
            $table->text('type')->nullable();
            $table->text('content')->nullable();



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
        Schema::dropIfExists('contacts', function (Blueprint $table){
            $table->string('first_name');
            $table->string('last_name');
            $table->dropColumn('name');

        });
    }
}
