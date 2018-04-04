<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sdm_photo extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'sdm_photo';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
