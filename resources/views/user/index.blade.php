@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('User') }}
                    <a href="{{ route('user.create') }}" class="btn btn-success float-right">Create New User</a>
                </div>

                <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->_id }}</th>
                            <td>{{ $user->email }}</td>
                            
                            @if($user->profile)
                            <td>{{ $user->profile->first_name }}</td>
                            @else
                            <td>-</td>
                            @endif
                            
                            @if($user->profile)
                            <td>{{ $user->profile->last_name }}</td>
                            @else
                            <td>-</td>
                            @endif

                            @if($user->profile)
                            <td>{{ $user->profile->dob }}</td>
                            @else
                            <td>-</td>
                            @endif

                            <td></td>
                            <td>
                                <a href="{{ route('user.edit', ['id' => $user->_id]) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('user.delete', ['id' => $user->_id]) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
