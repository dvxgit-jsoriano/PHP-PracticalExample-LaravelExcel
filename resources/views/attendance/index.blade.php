<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">


                <div class="flex mt-2 justify-between">
                    <div>Attendance Logs</div>
                    <div>
                        <button id="bFilter"
                            class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">Filter</button>
                        <button id="bExport" class="bg-green-600 text-white p-2 rounded-md hover:bg-green-700"
                            onclick="exportExcel()">Export</button>
                    </div>
                </div>

                <div class="table-responsive overflow-auto">
                    <table class="border-collapse border border-slate-400 mt-2" style="width: 8000px">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="border border-slate-300 p-2" style="width: 200px">Name</th>
                                @php
                                    $dt = Carbon\Carbon::parse('2022-03-01');
                                    $end = Carbon\Carbon::parse('2022-03-30');
                                @endphp
                                @while ($dt < $end)
                                    <th class="border border-slate-300 p-2" style="width: 120px">
                                        {{ $dt->toDateString() }}</th>
                                    <th class="border border-slate-300 p-2" style="width: 160px">Notes</th>
                                    <?php $dt->addDay(); ?>
                                @endwhile
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Active User Loop --}}
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border-slate-300 p-2">{{ $user->name }}</td>


                                    @php
                                        $start = Carbon\Carbon::parse('2022-03-01');
                                        $end = Carbon\Carbon::parse('2022-03-30');

                                        while ($start < $end) {
                                            $print_date = '<td class="border-slate-300 p-2 text-center">'.$start->toDateString().'</td>';
                                            $print_remarks = '<td class="border-slate-300 p-2">None</td>';
                                            $i=0;
                                            foreach ($user->attendance as $att) {
                                                if ($start->toDateString() == $att->attendance_date) {
                                                    $print_date = '<td class="border-slate-300 p-2 text-center">' . $att->attendance_date . '</td>';
                                                    $print_remarks = '<td class="border-slate-300 p-2">' . $att->remarks . '</td>';
                                                    break;
                                                }
                                                $i++;
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
                </div>


                <div class="mt-2">{{ $users->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function exportExcel() {
        console.log("exporting!");
    }
</script>
