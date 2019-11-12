<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = 'user_meta';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
