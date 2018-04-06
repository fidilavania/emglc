<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
     //protected $connection = 'pgsql';
    protected $table = 'mst_kelurahan';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
