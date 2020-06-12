<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    
    /**
     * The expense attributes
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'group_id',
        'title',
        'beneficiary',
        'amountSpent',
        'month',
    ];
}
