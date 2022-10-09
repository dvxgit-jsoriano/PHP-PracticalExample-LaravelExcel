<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'log_datetime',
        'status',
        'remarks'
    ];

    /**
     * Get the attendance that owns the logs.
     */
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
