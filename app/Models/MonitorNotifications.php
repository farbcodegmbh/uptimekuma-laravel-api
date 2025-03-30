<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorNotifications extends Model
{
    protected $table = 'monitor_notification';

    protected $connection = 'mariadb_kuma';

    public $timestamps = false;

    protected $fillable = [
        'monitor_id',
        'notification_id',
    ];

    public function monitor()
    {
        return $this->belongsTo(Monitor::class, 'monitor_id', 'id');
    }
}
