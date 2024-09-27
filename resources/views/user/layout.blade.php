
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike Customer Dashboard</title>
    <link rel="stylesheet" href="{{asset('build/assets/css/layout.css')}}">
    @yield('css')
</head>
<body>
    <header class="navbar">
        <div class="logo">STEPOLOGY</div>
        <div class="search-bar">
            <form action="{{route('search')}}" method="POST">
                @csrf
                <input type="text" placeholder="Search for products" name="keywords">
                <button>search</button>
            </form>
        </div>
        <div class="user-profile">
            <img src="user-icon.png" alt="Profile" class="profile-pic">
            <span class="username">John Doe</span>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <ul>
                <li><a href="{{route('dash')}}">Dashboard</a></li>
                <li><a href="{{route('viewProducts')}}">Products</a></li>
                <li><a href="{{route('gotoCart')}}">Cart</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Wishlist</a></li>
                <li><a href="{{route('profile')}}">Account Settings</a></li>
                <li><a href="#">Loyalty Points</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="/logout">Log Out</a></li>
            </ul>
        </aside>

        <main class="main-content">
           
           @yield('changeAble')
        </main>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Nike. All Rights Reserved.</p>
    </footer>
</body>
</html>
