<!DOCTYPE html>
<html lang="en">
<head>
 
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{asset('build/assets/css/login.css')}}">
    <script src="{{asset('build/assets/js/login.js')}}"></script>
</head>
<body>
    <div class="container">
        <!-- Circle background elements -->
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
        
        <!-- Login form -->
        <div class="login-box">
            @if (session('error'))
            <style>
                #showMe{
                    bottom: 39.5%
                }
            </style>
            <div class="errorMsg">
                <h3>{{session('error')}}</h3>
            </div>
                
            @endif

            <h2>Login Here</h2>


            <form action="/checkLogin" method="post">
                @csrf
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email or Phone" required autofocus="false">
            
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                
                <div id="showMe" onclick="showMe('password', 'showMe')">Show</div>
                
                <button type="submit">Log In</button>
            </form>
            
       

            <p>Dont't have an account</p>
            <a href="/signUp">Sign up</a>


        </div>
    </div>


</body>
</html>
