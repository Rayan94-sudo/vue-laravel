<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_User extends Model
{
    protected $table = 'groups_users';
    protected $fillable = ['id' ,'id_user','id_group'];

    use HasFactory;
}
