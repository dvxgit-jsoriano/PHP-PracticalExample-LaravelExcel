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
                    <table class="border-collapse border border-slate-400 mt-2" style="width: 2000px">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="border border-slate-300 p-2">Name</th>
                                <!-- 2022-10-01 -->
                                <th class="border border-slate-300 p-2">2022-10-01</th>
                                <th class="border border-slate-300 p-2">Notes</th>
                                <!-- 2022-10-02 -->
                                <th class="border border-slate-300 p-2">2022-10-02</th>
                                <th class="border border-slate-300 p-2">Notes</th>
                                <!-- 2022-10-03 -->
                                <th class="border border-slate-300 p-2">2022-10-03</th>
                                <th class="border border-slate-300 p-2">Notes</th>
                                <!-- 2022-10-04 -->
                                <th class="border border-slate-300 p-2">2022-10-04</th>
                                <th class="border border-slate-300 p-2">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Active User Loop --}}
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td class="border-slate-300 p-2">{{ $attendance->name }}</td>
                                    {{-- Set a counter for testing 4 dates --}}
                                    @php
                                        $ctr = 0;
                                    @endphp
                                    {{-- Column Loop for 4 days starting Oct 1 to 4 --}}
                                    @foreach ($attendance->attendance as $per_day)
                                        @if ($ctr < 4)
                                            <td class="border-slate-300 p-2 text-center">{{ $per_day->shift_start }}
                                            </td>
                                            <td class="border-slate-300 p-2">{{ $per_day->remarks }}</td>
                                        @endif
                                        {{-- Increment counter --}}
                                        @php
                                            $ctr++;
                                        @endphp
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <thead class="bg-blue-100">
                            <tr>
                                <th class="border border-slate-300 p-2">ID</th>
                                <th class="border border-slate-300 p-2">Name</th>
                                <th class="border border-slate-300 p-2">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td class="border-slate-300 p-2">{{ $attendance->id }}</td>
                                    <td class="border-slate-300 p-2">{{ $attendance->user->name }}</td>
                                    <td class="border-slate-300 p-2">{{ $attendance->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>


                <div class="mt-2">{{ $attendances->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function exportExcel() {
        console.log("exporting!");
    }
</script>
