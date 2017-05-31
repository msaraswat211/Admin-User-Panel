@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Users</h1>

    <table class="table">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>

        @forelse($users as $user)

        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name }}</td>
            <td>{{ $user->is_active==1 ? 'Active' : 'Not Active' }}</td>
            <td>{{ $user->created_at->diffFOrHumans() }}</td>
            <td>{{ $user->updated_at->diffForHumans() }}</td>
        </tr>

            @empty
                <p>No record</p>

            @endforelse
    </table>

@endsection