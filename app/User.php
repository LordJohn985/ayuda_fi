<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    #DEFAULT PROTECTED
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'last_name' ,'email', 'password', 'picture', 'phone', 'credits', 'born_date', 'score'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    #ROLES
    public function isAdmin(){
        return $this->role_id == 1;
    }

    #RELATIONSHIPS
    public function publications()
    {
        return $this->hasMany('App\Publication');
    }
    public function postulations()
    {
        return $this->hasMany('App\Postulation');
    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function calification()
    {
        return $this->hasOne('App\Calification');
    }

}
