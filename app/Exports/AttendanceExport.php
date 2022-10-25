<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{
    public function view(): View
    {
        return view('attendance.export', [
            'users' => User::with('attendance')->get()
        ]);
    }
}
