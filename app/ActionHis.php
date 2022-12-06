<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionHis extends Model
{
    //
    protected $fillable = [
        'uid',
        'logickey',
    ];

    public function content()
    {
        return $this->hasOne('App\Content', 'id', 'logickey');
    }

}
