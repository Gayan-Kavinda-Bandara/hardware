<?php

namespace App\Models;

use App\Models\User;
use App\Models\DeviceConnet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_check_id',
        'other_device_name',
        'serial_no',
        'model',
        'brand',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,DeviceConnet::class,'device_id','user_id',);
    }
}
