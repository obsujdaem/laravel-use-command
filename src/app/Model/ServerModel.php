<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServerModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'servers';
}
