<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mst_gelar extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'mst_gelar';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
