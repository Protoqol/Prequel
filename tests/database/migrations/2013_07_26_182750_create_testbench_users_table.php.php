<?php

declare(strict_types = 1);

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTestbenchUsersTable
 */
class CreateTestbenchUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testbench_users', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });

        $now = Carbon::now();

        DB::table('testbench_users')->insert([
            'email'      => 'hello@orchestraplatform.com',
            'password'   => Hash::make('123'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('testbench_users');
    }
}
