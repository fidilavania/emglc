<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kab extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'mst_kabupaten';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
