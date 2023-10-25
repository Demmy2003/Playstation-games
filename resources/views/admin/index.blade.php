@extends('layouts.app')

@section('content')
    <h1>Admin: User Management</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Toggle Moderator</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.assign', $user->id) }}">
                        @csrf
                        <button type="submit">
                            {{ $user->hasRole('moderator') ? 'Remove Moderator' : 'Assign Moderator' }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
