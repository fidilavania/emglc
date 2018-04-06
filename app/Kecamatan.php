<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
     //protected $connection = 'pgsql';
    protected $table = 'mst_kecamatan';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
