<table>
    <thead>
        <tr>
            <th>ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
