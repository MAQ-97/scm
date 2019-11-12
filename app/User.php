<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $appends = [
        'role_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRoleNameAttribute()
    {
        return $this->getRoleNames()->first();
    }

    public function metas()
    {
        return $this->hasMany('App\UserMeta', 'user_id', 'id');
    }

    public function get_meta($key, $default = false)
    {
        $row = $this->metas->where('key', $key)->first();
        $value = $default;

        if ($row) {
            $value = $row->value;
        }

        return $value;
    }

    public function get_distributor(){
        return $this->hasMany('App\Client', 'distributor_id', 'id');
    }

}
