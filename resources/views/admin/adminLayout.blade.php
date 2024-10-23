<!DOCTYPE html>
<html lang="en">
<head>
    @yield('cssSection')
    <meta charset="UTF-8">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
   
    <style>
        
       .mainDiv{
        width: 100%;
       }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('build/assets/css/adminLayout.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="{{route('dash')}}">Dashboard</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="{{route('productTable')}}">Products</a></li>
                <li><a href="#">User Orders</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="mainDiv" id="mainDiv">
            @yield('mainContents')
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
</body>
</html>
