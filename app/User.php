<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
/*use App\Events\UserDeleted;*/

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

    #EVENTS
    protected static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            $user->postulations()->delete();
            $user->questions()->delete();
            $user->califications()->delete();
            $user->publications()->delete();
            // do the rest of the cleanup...
        });
    }

    /*protected $events = [
        'deleted' => UserDeleted::class,
    ];*/

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
    public function califications()
    {
        return $this->hasMany('App\Calification');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }
}
