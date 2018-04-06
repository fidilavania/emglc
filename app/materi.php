<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materi extends Model
{
    //protected $connection = 'pgsql';
    protected $table = 'materi';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
