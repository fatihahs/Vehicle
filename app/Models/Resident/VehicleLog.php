<?php

namespace App\Models\Resident;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleLog extends Model
{
    use HasFactory;

    protected $table = 'vehicle_log';

    protected $fillable = [
        'ResidentID',
        'status'
    ];

    public function resident(){
        return $this->belongsTo(\App\Models\Resident\Resident::class, 'ResidentID', 'id');
    }
}
