<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','device_id','section_id','issue','assDremarks','assDremarksState','techRemarks','hddformat','techRemarksState','comCanRepair','assITRemarks','assITRemarksState','ItDRemarks','ItDRemarksState'];

}
