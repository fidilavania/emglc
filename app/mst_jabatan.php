<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mst_jabatan extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'mst_jabatan';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
