<?php

namespace App\Models\Resident;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleLog extends Model
{
    use HasFactory;

    protected $table = 'vehicle_log';

    protected $fillable = [
        'Name',
        'TagID',
        'PlateNo',
        'status'
    ];
}
