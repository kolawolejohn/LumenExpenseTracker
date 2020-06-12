<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    /**
     * The user attribute
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'income',
        'savings',
        'budget',
        'balance',
    ];
}
