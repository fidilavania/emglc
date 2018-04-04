<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mst_kantor extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'mst_kantor';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
