@extends('admin.adminLayout')
@section('cssSection')
<link rel="stylesheet" href="{{asset('build/assets/css/delievry.css')}}">
    
@endsection
@section('mainContents')

<div class="table-container">
    <h1> List</h1>
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guys as $guy)
            <tr>
                <td>{{ $guy->id }}</td>
                <td>{{ $guy->name }}</td>
                <td>{{ $guy->email }}</td>
                <td>{{ $guy->userType }}</td>
                <td><button class="action-btn view">View</button> <button class="action-btn delete">Delete</button></td>
            </tr>
            @endforeach
         
           
        </tbody>
    </table>
</div>

@endsection