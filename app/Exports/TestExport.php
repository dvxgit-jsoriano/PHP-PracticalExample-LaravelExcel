<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class TestExport implements FromView
{
    use Exportable;

    private $users;

    public function __construct() {
        $this->users = User::all();
    }

    public function view(): View
    {
        return view('attendance.test', [
            'users' => $this->users
        ]);
    }
}
