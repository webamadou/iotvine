<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('service_api')->nullable()->comment("The api with wich the user sign up");
            $table->mediumText('token')->nullable()->comment("The token of the api used to sign up");
            $table->string("fullname")->nullable();
            $table->mediumText('image')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('url')->default(null)->comment("An id used to create an referencial url");
            $table->integer("contest_alert")->nullable()->comment("Weather or not want to receive alert about his/her contest");
            $table->integer("newsletter_notifications")->nullable()->comment("If the user will receive our newsletter");
            $table->string("notification_email")->nullable()->comment("Alternative email to use for notifications. If not define default email is used");
            $table->string("alternative_name")->nullable()->comment("An alternative name that go with the alternative email");

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
