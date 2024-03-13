<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceCheck extends Model
{
    use HasFactory;

    protected $fillable = ['main_device_name'];
}
