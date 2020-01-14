<?php

use App\Model\ServerModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAdditionalServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $servers = ServerModel::all();

        foreach ($servers as $server) {

            DB::purge('additional_mysql');
            Config::set('database.connections.additional_mysql.host', $server->host);

            Schema::connection('additional_mysql')->create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('login');
                $table->string('password');
                $table->string('email');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_additional_servers');
    }
}
