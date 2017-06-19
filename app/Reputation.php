<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Reputation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'necesary_score',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
