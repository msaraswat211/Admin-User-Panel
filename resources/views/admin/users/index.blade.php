@extends('layouts.admin')

@section('content')

    {{-- check session of deleted user and show flash msg--}}
    @if(Session::has('deleted_user'))

        <p class="bg-danger">{{session('deleted_user')}}</p>

        @endif

    <h1>Users</h1>

    {{--all user in table form--}}
    <table class="table">
       <thead>
         <tr>
             <th>Id</th>
             <th>Photo</th>
             <th>Name</th>
             <th>Email</th>
             <th>Role</th>
             <th>Status</th>
             <th>Created</th>
             <th>Updated</th>
          </tr>
        </thead>
        <tbody>

        @if($users)

            @foreach($users as $user)

           <tr>
              <td>{{$user->id}}</td>
               <td> <img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/180x100'}}" alt="" ></td>
              <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>{{$user->role ? $user->role->name : 'User has no role'}}</td>
               <td>{{$user->is_active == 1 ? 'Active' : 'Not Active' }}</td>
              <td>{{$user->created_at->diffForHumans()}}</td>
              <td>{{$user->updated_at->diffForHumans()}}</td>
           </tr>

            @endforeach

          @endif

       </tbody>
     </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{ $users->links()}}

        </div>
    </div>

@endsection