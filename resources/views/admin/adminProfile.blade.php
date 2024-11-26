@extends('admin.adminLayout')
@section('cssSection')
<link rel="stylesheet" href="{{asset('build/assets/css/myProfile.css')}}">
    
@endsection
@section('mainContents')
    
<form enctype="multipart/form-data" method="POST" action="/changeProfile" >
    @csrf
    <div class="profile-picture">
        <img 
            id="profilePic" 
            src="{{ asset('storage/images/profile/' . ($user->photo ?? 'default.jpg')) }}" 
            alt="Profile Picture"/>
            <label for="image"></label>
            <input type="file" name="image" id="image" accept="image/*" required>
    </div>
    <div class="profile-info">
        <label for="name">Name:</label>
        <input type="text" id="name" name="username" value="{{ $user->name }}">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">

        <button id="saveButton" type="submit">Save Changes</button>
    </div>
</form>


    
    <script src="{{asset('build/assets/js/myProfile.js')}}"></script>
@endsection