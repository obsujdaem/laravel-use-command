<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRegistrationModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'users';
}
