<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calification extends Model
{

    use softDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
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
    public function publications()
    {
        return $this->belongsTo('App\Publication');
    }
    public function label()
    {
        return $this->belongsTo('App\Label');
    }
}
