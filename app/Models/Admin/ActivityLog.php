<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{

    protected $fillable = [
        'AdminID', 'description'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
