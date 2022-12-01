<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdHis extends Model
{
    protected $fillable = [
        'uid',
        'target',
        'logickey',
        'before',
        'after',
        'ext'
    ];

}
