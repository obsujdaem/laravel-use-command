<?php

namespace App\Console\Commands;

use App\Model\PostModel;
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
                        {server : ID сервера куда переместить user,posts}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'input {users.id} to {servers.id} to move user.posts on additional server';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find($this->argument('user'));
        $server = ServerModel::find($this->argument('server'));
        $posts = PostModel::where('user_id', $this->argument('user'))->get();

        $postsCount = count($posts);

        if ($user) {
            $this->comment("Пользователь $user->login найден");

            if ($server) {
                $this->comment("Сервер $server->host найден");

                if ($postsCount > 0) {
                    $this->comment("У данного пользователя : $postsCount post(s) ");

                    DB::purge('additional_mysql');
                    Config::set('database.connections.additional_mysql.host', $server->host);

                    foreach ($posts as $post) {
                        DB::connection('additional_mysql')->table('posts')->insertGetId([
                            'title' => "$post->title",
                            'text' => "$post->text",
                            'user_id' =>$post->user_id,
                            'created_at' => "$post->created_at",
                            'updated_at' => "$post->updated_at"
                        ]);
                    }

                    foreach ($posts as $post) {
                        $post->delete();
                    }

                    $this->question("$postsCount post(s) пользователя $user->login был(и) перенесен(ы) на сервер $server->host");

                } else {
                    $this->question("У данного пользователя нет постов ");
                }

            } else {
                $this->error('Сервер не найден');
            }

        } else {
            $this->error('Пользователь не найден');

            if ($server) {
                $this->comment("Сервер $server->host найден");

            } else {
                $this->error('Сервер не найден');
            }
        }
    }
}
