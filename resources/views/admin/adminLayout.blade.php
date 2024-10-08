<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <style>
        @yield('cssSection')
        
       .mainDiv{
        width: 100%;
       }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  
    <script>
        
        
        const jq = jQuery.noConflict(); 
        
        function gotoTable() {
        
            jq.ajax({
                type: "GET",
                url: "{{ route('productTable') }}",
                success: function(data) {
                    jq('#mainDiv').html(data);
                },
                error: function() {
                    jq('#mainDiv').html('<p>Error loading content.</p>');
                }
            });
          
        }   
    </script>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-light" id="sidebar" style="width: 250px; height: 100vh;">
            <div class="sidebar-header p-3">
                <h4>Xtreme</h4>
            </div>
            <ul class="list-unstyled">
                <li class="p-2">
                    <i class="fas fa-user-circle"></i> Steave Jobs
                </li>
                <li><a href="{{route('dash')}}" class="p-2">Dashboard</a></li>
                <li><a href="#" class="p-2">Profile</a></li>
                <li><button id="table" onclick="gotoTable()" class="p-2">Table</button></li>
                <li><a href="#" class="p-2">Icon</a></li>
                <li><a href="#" class="p-2">Blank</a></li>
                <li><a href="#" class="btn btn-danger mt-3 p-2">Upgrade to Pro</a></li>
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
