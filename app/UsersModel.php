<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class UsersModel extends Model
{
    use Notifiable;
    protected $table = 'users';
    public $timestamps = false;

    protected $guarded = [];  
}
