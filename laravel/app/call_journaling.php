<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class call_journaling extends Model
{
    protected $connection = 'mysqltwo';
    protected $table = 'call_journaling';
    public $fillable = ['id','agent','calltype','date','phone','callstart','callend','duration','duration_in_ss','Call_note','status'];

    public $timestamps = false;
}
