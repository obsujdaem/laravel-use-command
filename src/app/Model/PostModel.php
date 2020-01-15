<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'posts';
}
