<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $table = 'monitor';

    protected $connection = 'mariadb_kuma';

    protected $fillable = [
        'name',
        'url',
        'interval',
        'url',
        'type',
        'push_token',
        'active',
        'user_id',
        'interval',
    ];
}
