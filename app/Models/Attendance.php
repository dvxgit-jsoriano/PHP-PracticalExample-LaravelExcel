<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'attendance_date',
        'shift_start',
        'shift_end',
        'remarks',
        'overtime',
    ];

    /**
     * Get the logs for the attendance.
     */
    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    /**
     * Get the user that owns the attendances.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
