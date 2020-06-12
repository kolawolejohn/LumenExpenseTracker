<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseGroup extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
    ];
}
