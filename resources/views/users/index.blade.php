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
                        <button id="bFilter" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">Filter</button>
                        <button id="bExport" class="bg-green-600 text-white p-2 rounded-md hover:bg-green-700">Export</button>
                    </div>
                </div>

                <table class="border-collapse border border-slate-400 w-full mt-2">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="border border-slate-300 p-2">ID</th>
                            <th class="border border-slate-300 p-2">Name</th>
                            <th class="border border-slate-300 p-2">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border-slate-300 p-2">{{ $user->id }}</td>
                                <td class="border-slate-300 p-2">{{ $user->name }}</td>
                                <td class="border-slate-300 p-2">{{ $user->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-2">{{ $users->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>
