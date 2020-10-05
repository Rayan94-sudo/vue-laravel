<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table = 'groups';
    protected $fillable = ['id' ,'name'];

 /**
     * The users that belong to the group.
     */
    public function users()
{
   //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
    return $this->belongsToMany(
        User::class, 'group_user');
}

    use HasFactory;
}
