<?php

namespace App\Console\Commands;

use App\Model\ServerModel;
use App\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class movingUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:moving
                        {user : ID пользователя}
                        {server : ID сервера куда переместить пользователя}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'input {users.id} to {servers.id} to move user on additional server';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find($this->argument('user'));
        $server = ServerModel::find($this->argument('server'));

        if ($user) {
            echo "Пользователь $user->login найден";

            if ($server) {
                echo "Сервер $server->host найден";
                $user->delete();
                DB::purge('additional_mysql');
                Config::set('database.connections.additional_mysql.host', $server->host);

                DB::connection('additional_mysql')->table('users')->insertGetId([
                    'login' => "$user->login",
                    'password' => "$user->password",
                    'email' => "$user->email",
                    'created_at' => "$user->created_at",
                    'updated_at' => "$user->updated_at"
                ]);

            } else {
                echo 'Сервер не найден  ';
            }

        } else {
            echo 'Пользователь не найден  ';

            if ($server) {
                echo "Сервер $server->host найден";

            } else {
                echo 'Сервер не найден  ';
            }
        }
    }
}
