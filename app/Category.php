<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasRoles;

    public $timestamps = false;

    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany('App\Category', 'category_id');
    }
}
