<table>
    <thead>
        <tr>
            <th>Name</th>
            @php
                $dt = Carbon\Carbon::parse('2022-03-01');
                $end = Carbon\Carbon::parse('2022-03-30');
            @endphp
            @while ($dt < $end)
                <th>{{ $dt->toDateString() }}</th>
                <th>Notes</th>
                <?php $dt->addDay(); ?>
            @endwhile
        </tr>
    </thead>
    <tbody>
        {{-- Active User Loop --}}
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>

                @php
                    $start = Carbon\Carbon::parse('2022-03-01');
                    $end = Carbon\Carbon::parse('2022-03-30');

                    while ($start < $end) {
                        $print_date = '<td>' . $start->toDateString() . '</td>';
                        $print_remarks = '<td>None</td>';
                        $i = 0;
                        $found = false;
                        foreach ($user->attendance as $att) {
                            if ($start->toDateString() == $att->attendance_date) {
                                $print_date = '<td>' . $att->attendance_date . '</td>';
                                $print_remarks = '<td>' . $att->remarks . '</td>';
                                $found = true;
                                break;
                            }
                            $found = false;
                            $i++;
                        }
                        if (!$found) {
                            $print_remarks = '<td>ABSENT</td>';
                        }
                        echo $print_date;
                        echo $print_remarks;
                        $start->addDay();
                    }
                @endphp
            </tr>
        @endforeach
    </tbody>
</table>
