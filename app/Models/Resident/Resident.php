<?php

namespace App\Models\Resident;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = "residents";

    protected $fillable = [
        'TagID',
        'Name',
        'PlateNo',
        'Phone',
        'Address',
    ];

    public $timestamps = true;

    public function logs(){
        return $this->hasMany(VehicleLog::class, 'ResidentID');
    }
}
