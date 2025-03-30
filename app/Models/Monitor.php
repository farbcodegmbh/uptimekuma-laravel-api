<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $table = 'monitor';

    protected $connection = 'mariadb_kuma';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'url',
        'interval',
        'url',
        'type',
        'push_token',
        'active',
        'user_id',
        'parent'
    ];


    public function notifications()
    {
        return $this->hasMany(MonitorNotifications::class, 'monitor_id', 'id');
    }
}
