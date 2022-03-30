<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_employment');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->float('salary', 6, 3);
            $table->timestamps();
            $table->unsignedBigInteger('admin_created_id');
            $table->foreign('admin_created_id')->references('id')->on('users');
            $table->unsignedBigInteger('admin_updated_id');
            $table->foreign('admin_updated_id')->references('id')->on('users');
            $table->nestedSet();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropNestedSet();
        });
        Schema::dropIfExists('users');
    }
}
