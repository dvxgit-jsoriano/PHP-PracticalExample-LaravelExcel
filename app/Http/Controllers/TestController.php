<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    function testSeedAttendances()
    {
        /**
         * Initialize current date and end date for one month duration (range)
         */
        $current_date = Carbon::create('2022-03-01');
        $start_date = Carbon::create('2022-03-01');
        $end_date = Carbon::create('2022-03-31');

        AttendanceLog::truncate();
        Attendance::query()->delete();

        do {
            $users = User::all();
            foreach ($users as $user) {
                /**
                 * Reset current time and end time for the day
                 */
                $current_time = Carbon::create($current_date->toDateTimeString());
                $end_time = Carbon::create($current_date->toDateTimeString());
                $current_time->addHours(9);
                $end_time->addHours(17);

                /**
                 * 80% chance for absent on the current date
                 */
                if (rand(0, 100) > 80) continue;

                /**
                 * Use transaction to avoid data inconsistency
                 */
                DB::transaction(function () use ($current_date, $current_time, $end_time, $user) {
                    $attendance = Attendance::create([
                        'user_id' => $user->id,
                        'attendance_date' => $current_date,
                        'shift_start' => '09:00',
                        'shift_end' => '17:00',
                        'remarks' => '',
                        'overtime' => 0
                    ]);

                    $time_in = rand(0, 2);
                    $status = 'TIME IN';

                    switch ($time_in) {
                        case 0: // TIME IN EARLY
                            $secs_early = rand(0, 900); // random 15 mins early
                            $current_time->subSeconds($secs_early);
                            break;
                        case 1: // TIME IN LATE
                            $secs_late = rand(0, 900); // random 15 mins late
                            $current_time->subSeconds($secs_late);
                            break;
                        case 2: // TIME IN PRE-SHIFT OT
                            $secs_preshift_ot = rand(3600, 4500); // random 1 hour to 1:15 mins
                            $current_time->subSeconds($secs_preshift_ot);
                            break;
                    }

                    $time_in_flag = true;
                    do {
                        $attendance_log = AttendanceLog::create([
                            'attendance_id' => $attendance->id,
                            'log_datetime' => $current_time,
                            'status' => $status
                        ]);

                        /**
                         * If pre shift OT detected, advance the time and switch off flag
                         */
                        if ($time_in_flag && $time_in == 2) {
                            $attendance_log = AttendanceLog::create([
                                'attendance_id' => $attendance->id,
                                'log_datetime' => $current_time,
                                'status' => 'PRE-SHIFT OT'
                            ]);
                            $time_in_flag = false;
                        }

                        $status_list = ['Calling', 'Training', 'Coaching', 'Break'];
                        $random_key = array_rand($status_list);
                        $status = $status_list[$random_key];                        // The next status

                        $current_time = $current_time->addSeconds(7000, 7500);      // The next time
                    } while ($current_time < $end_time);
                });

                echo $current_date . "<br>";
            }

            $current_date->addDay()->startOfDay(); // the next day

        } while ($current_date < $end_date);
    }
}
