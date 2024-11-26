@extends('user.layout')
@section('css')
<link rel="stylesheet" href="{{asset('build/assets/css/myProfile.css')}}">
    
@endsection
@section('changeAble')
    
    <form enctype="multipart/form-data" action="{{route('profileChange')}}" method="POST">
        @csrf
        <div class="profile-container">
            <div class="profile-header">
                <h2>Edit Profile</h2>
            </div>
            
            <div class="profile-picture">
                <img id="profilePic" src="{{asset('storage/images/profile/'.$user->photo)}}" alt="My pic"  value="{{$user->photo}}">
                <label for="image"></label>
                <input type="file" id="image" name="image">
            </div>
            <div class="profile-info">
                <label for="name">Name:</label>
                <input type="text" id="name" name="username" value="{{$user->name}}">
    
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{$user->email}}">
    
                <button id="saveButton">Save Changes</button>
            </div>
        </div>
    
        <script src="{{asset('build/assets/js/myProfile.js')}}"></script>
    </form>
@endsection