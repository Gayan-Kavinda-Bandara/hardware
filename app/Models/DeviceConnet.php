<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceConnet extends Model
{
    use HasFactory;
    protected $table ="device_connets";
    protected $fillable = ['user_id','device_id' ,'assign_date','release_date','state'];
}
