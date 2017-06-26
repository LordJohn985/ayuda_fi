<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Publication extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'title', 'finish_date', 'creation_date', 'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    #RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function postulations()
    {
        return $this->hasMany('App\Postulation');
    }
    public function calification()
    {
        return $this->hasOne('App\Calification'); /*probar con hasone*/
    }
}
