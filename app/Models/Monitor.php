<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $table = 'monitor';

    protected $connection = 'mysql_kuma';
    protected $fillable = [
        'name',
        'url',
        'status'
    ];
}
