<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->nullable();
        $table->string('phone')->nullable();
        $table->date('birth')->nullable();
        $table->string('gender')->nullable();
        $table->string('profile_image')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['username', 'phone', 'birth', 'gender', 'profile_image']);
    });
}

};
